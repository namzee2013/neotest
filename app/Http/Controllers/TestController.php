<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\UserTestResult as UserTestResult;
use App\UserTest as UserTest;
use App\Category;
use App\Type;
use App\Option;
use App\Question;
use App\TestQuestion;
use Auth;
use App\Http\Requests\TestRequest;
use DateTime;
use Log;
use App\User;
use Mail;
use Session;
use DB;
class TestController extends Controller
{
    function __construct(Test $test, Type $type, Category $category, TestQuestion $testquestion,Question $question)
    {
        $this->test = $test;
        $this->testquestion = $testquestion;
        $this->category = $category;
        $this->question = $question;
        $this->type = $type;
        $type = $this->type->getAllType();
        $categoryselect = $this->category->getAllCategory();
        view()->share(['categoryselect' => $categoryselect, 'type' => $type]);
    }
    public function getInformation($link)
    {
        return view('test.info',compact('link'));
    }

    public function getDirection(Request $request)
    {
    	$email = $request->email;
        $name  = $request->name;
        $link = $request->link;

        $user =  User::where('email',$email)->first();
        $test = Test::where('link',$link)->first();
        $user_test = UserTest::where('user_id',$user['id'])->where('test_id',$test['id'])->first();

        $category = Category::where('id',$test['category_id'])->first();
        $category_name = $category['name'];

        if ($user_test) {
            $user_test_result = UserTestResult::where('usertest_id',$user_test['id'])->first();
            if (!$user_test_result) {
                Session::push('email',$email);
                return view('test.direction',[
                    'name'          => $name,
                    'link'          => $link,
                    'category_name' => $category_name,
                    'timetotal'     => $test['timetotal']
                    ]);
            }else{
                return redirect()->route('getInfo',$link)->with('msg','Ban da lam bai nay roi !');
            }
        }else{
            return redirect()->route('getInfo',$link)->with('msg','Ban khong duoc cap quyen lam bai nay !');
        }
    }
    private function getOption($question_id){
        return Option::where('question_id',$question_id)->get()->toArray();
    }

    private function getTestQuestion($test_id)
    {
        return TestQuestion::where('test_id',$test_id)->get()->toArray();
    }

    private function getTestQuestionFirst($test_id)
    {
        return TestQuestion::where('test_id',$test_id)->first();
    }

    private function getQuestion($id)
    {
        return Question::where('id',$id)->get()->toArray();
    }

    private function getCategory($category_id)
    {
        return Category::where('id',$category_id)->first();
    }

    public function getAllQuestion(Request $request, $link)
    {

        $email = $request->session()->get('email');
        $now = $this->getCurrentDateTime();
        $test = Test::where('link',$link)->first();
        $timetotal = $test['timetotal'];
        $gettestquestion = $this->getTestQuestion($test['id']);
        $array = [];
        foreach ($gettestquestion as $key => $value) {
            $array[]['question'] = $this->getQuestion($value['question_id']);
            $array[$key]['option'] = $this->getOption($value['question_id']);
        }
        $category_id = $array[0]['question'][0]['category_id'];
        $category[] = $this->getCategory($category_id);
        $name = array_shift($category)['name'];

        $check = UserTest::where('user_id',$test->user_id)
            ->where('test_id',$test->id)
            ->get();
        if (count($check) > 0) {
            return "lam roi ma anh !!!";
        }else{
            return view('test.test',[
                'timetotal' => $timetotal,
                'now'       => $now,
                'array'     => $array,
                'link'      => $link,
                'name'      => $name,
                'email'     => $email[0],
                ]);
        }
    }

    public function getEachQuestion(Request $request, $link, $id){
        $email = $request->session()->get('email');
        $now = $this->getCurrentDateTime();
        $test = Test::where('link',$link)->first();
        $timetotal = $test['timetotal'];
        $gettestquestion = $this->getTestQuestion($test['id']);
        $count = count($gettestquestion);
        $id = --$id;
        $question_id = $gettestquestion[$id]['question_id'];

        $array['question'] = $this->getQuestion($question_id);
        $array['option'] = $this->getOption($question_id);
        $category_id = $array['question'][0]['category_id'];
        $category[] = $this->getCategory($category_id);
        $name = array_shift($category)['name'];

        return view('test.eachquestion',
            [
                'timetotal' => $timetotal,
                'now'       => $now,
                'array'     => $array,
                'link'      => $link,
                'id'        => $id,
                'count'     => $count,
                'name'      => $name,
                'email'     => $email[0],
            ]);
    }

    public function getCurrentDateTime(){
        $tampnow = new DateTime();
        $now = $tampnow->format("Y-m-d H:i:m");
        return $now;
    }

    public function postTest(Request $request){

        if ($request->ajax()) {
            $results = $request->results;
            $link = $request->link;
            $timeused = $request->timeused;
            $email = $request->email;

            $test = Test::where('link',$link)->first();
            $user = User::where('email',$email)->first();

            $updateusertest = UserTest::where('user_id',$user['id'])
                ->where('test_id',$test['id'])
                ->update(['timespend' => $timeused]);

            $usertest = UserTest::where('user_id',$user['id'])
                ->where('test_id',$test['id'])
                ->first();
            if($results != null){
                foreach ($results as $key => $value) {
                    $usertestresult = new UserTestResult;
                    $usertestresult->usertest_id = $usertest['id'];
                    $usertestresult->question_id = $value['question_id'];
                    $result =  "[" . implode(",",$value['option_id']) . "]";
                    $usertestresult->result = $result;
                    $usertestresult->save();
                }
            }
            return 'ok';
        }
    }

    public function testDone(Request $request)
    {
        $request->session()->forget('email');
        return view('test.done');
    }

    public function getList()
    {
    	$test = $this->test->getAllTest();
    	return view('admin.test.list',compact('test'));
    }

    public function getAdd()
    {
    	return view('admin.test.add');
    }
    public function postAdd(TestRequest $request)
    {
    	$test = $this->test;
    	$test->link = $this->randomString(20);
    	$test->expired = $request->expired;
    	$test->timetotal = $request->timetotal;
    	$test->user_id = Auth::user()->id;
        $test->category_id=$request->category_id;
    	$test->save();

        $category_id  = $request->category_id;
		$qsinglequest = $request->qOneQuest;
		$qmultiquest  = $request->qMultiQuest;
		$qtextquest   = $request->qTextQuest;

    	$radioquest = Question::select()->where('category_id',$category_id)->where('type_id',1)->get()->toArray();
    	$checkquest = Question::select()->where('category_id',$category_id)->where('type_id',2)->get()->toArray();
    	$textquest = Question::select()->where('category_id',$category_id)->where('type_id',3)->get()->toArray();

    	$random_radio=array_rand($radioquest,$qsinglequest);
    	for ($i=0; $i < count($random_radio); $i++) {
    		$testquestion = new TestQuestion;
    		$testquestion->test_id = $test['id'];
    		$testquestion->question_id = $radioquest[$random_radio[$i]]['id'];
    		$testquestion->save();
    	}
    	$random_check=array_rand($checkquest,$qmultiquest);
    	for ($i=0; $i < count($random_check); $i++) {
    		$testquestion = new TestQuestion;
    		$testquestion->test_id = $test->id;
    		$testquestion->question_id = $checkquest[$random_check[$i]]['id'];
    		$testquestion->save();
    	}
    	$random_text=array_rand($textquest,$qtextquest);
    	for ($i=0; $i < count($random_text); $i++) {
    		$testquestion = new TestQuestion;
    		$testquestion->test_id = $test->id;
    		$testquestion->question_id = $textquest[$random_text[$i]]['id'];
    		$testquestion->save();
    	}

        return redirect()->route('admin.test.getList')->with(['flash_messages'=>'Add new Test success']);

    }
    function randomString($lengh)
    {
    	$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randstring = '';
	    for ($i = 0; $i < $lengh; $i++) {
	        $randstring .=  $characters[rand(0, strlen($characters)-1)];
	    }
	    return $randstring;
    }
    public function getDeleteTest($id)
    {
        $test = $this->test->getTestByID($id);
        $test->delete($id);
        return redirect()->route('admin.test.getList')->with(['flash_messages'=>'Delete Test success']);
    }
    public function getViewTest($id)
    {
        $test = Test::find($id);
        $gettestquestion = TestQuestion::where('test_id',$test['id'])->paginate(5);
        $array = [];
        foreach ($gettestquestion as $key => $value) {

            $array[]['question'] = $this->getQuestion($value['question_id']);
            $array[$key]['option'] = $this->getOption($value['question_id']);
        }
        $isPostBack = $this->isPostBack();
        //dd($isPostBack);
        shuffle($array);
        return view('admin.test.view',compact('array','gettestquestion','test'));
    }
    function isPostBack()
    {
       return ($_SERVER['REQUEST_METHOD'] == 'GET');
    }
    public function chooseCategory()
    {
        return view('admin.test.choosecategory');
    }
    public function getAddCustomize($cate)
    {
        $getquestion = Question::where('category_id',$cate)->paginate(5);

        return view('admin.test.customize-add',compact('getquestion','cate'));
    }
    public function postAddCustomize(Request $request)
    {

        if($request->ajax())
        {
            $test = $this->test;
            $test->link = $this->randomString(20);
            $test->expired = $request->expired;
            $test->timetotal = $request->timetotal;
            $test->user_id = Auth::user()->id;
            $test->category_id = $request->category;
            $test->save();
            $id = $test->id;

            $arr = $request->arr;
            foreach ($arr as $key => $item) {
                $testquestion = new TestQuestion;
                $testquestion->test_id = $id;
                $testquestion->question_id = $item['id'];
                $testquestion->save();
            }
            return "ok";
        }


    }
    public function sendLinkTest(Request $request)
    {
        $id = DB::table('roles')->select('id')->where('role','=','member')->get()->first()->id;
        $test_id = $request->test_id;
        $arr_email   = $request->email;

        $email = explode(',',$arr_email);
        $totalEmail = count($email);
        for ($i=0; $i <$totalEmail; $i++) {
            $user_exist = User::where('email', $email[$i])->get()->first();
            if($user_exist == null)
            {
                $user = new User;
                $user->name     = $email[$i];
                $user->email    = $email[$i];
                $user->password = $this->randomString(10);
                $user->role_id  = $id;
                $user->save();

                $usertest = new UserTest;
                $usertest->test_id = $test_id;
                $usertest->user_id = $user->id;
                $usertest->timespend = 0;
                $usertest->save();
            }
            else{
                $usertest = new UserTest;
                $usertest->test_id = $test_id;
                $usertest->user_id = $user_exist->id;
                $usertest->timespend = 0;
                $usertest->save();
            }



            $data = array(
              'email' => $email[$i],
              'link'  => $request->link,
            );
            if($email[$i] != null){
                Mail::send('admin.mail',$data ,function($message) use ($data){
                    $message->from('luckystarhotelct@gmail.com','NeoLab Vietnam');
                    $message->to($data['email']);
                    $message->subject('Link the test');
                });
            }
        }


        return redirect()->route('admin.test.getList')->with(['flash_messages'=>'Send link Test success']);
    }
    public function getFormAddTest()
    {
        return view('admin.test.add-test');
    }
    public function addNewTest($cate)
    {
        $test = $this->test;
        $test->link        = $this->randomString(20);
        $test->expired     = date("Y-m-d H:i:s", strtotime("+3 day"));
        $test->timetotal   = 20;
        $test->user_id     = Auth::user()->id;
        $test->category_id = $cate;
        $test->save();

        return redirect('admin/test/update/'.$test->id);
        //return redirect('admin/test/update/33');
    }
    public function updateQuestionOfTest($id)
    {
        $test = $this->test->getTestByID($id);
        $gettestquestion = TestQuestion::where('test_id',$test['id'])->orderBy('id','DESC')->paginate(5);
        $array = [];
        foreach ($gettestquestion as $key => $value) {

            $array[]['question'] = $this->getQuestion($value['question_id']);
            $array[$key]['option'] = $this->getOption($value['question_id']);
        }

        return view('admin.test.view',compact('array','gettestquestion','test'));
    }
    public function postUpdateQuestionOfTest(Request $request,$id)
    {
        $test = $this->test->getTestByID($id);
        $question = $this->question;
        $question->title = $request->question;
        $question->category_id  = $test->category_id;
        $question->user_id = Auth::user()->id;
        $question->type_id = $request->type;
        if ($request->hasFile('image')) {
            $files = $request->file('image');
            $filename        = str_slug(date("Y-m-d H-i-s").$files->getClientOriginalName());
            $filetype        = $files->getClientOriginalExtension();
            $picture         = "$filename.$filetype";
            $destinationPath = base_path() . '/uploads/images/';
            $files->move($destinationPath, $picture);
            $question->image = $picture; // cắt xong lưu csdl
        }

        $question->save();

        $type =  $request->type;
        if($type == 1)
        {
            $opts = $request->option;
            $corr = $request->correct;
            if($corr != null)
            {
                $option = new Option;
                $option->content = $opts[$corr];
                $option->status = 1;
                $option->question_id = $question->id;
                $option->save();
                unset($opts[$corr]);
                foreach ($opts as $key => $value) {
                    $option = new Option;
                    $option->content = $value;
                    $option->status = 0;
                    $option->question_id = $question->id;
                    $option->save();
                }

            }
        }
        elseif($type == 2)
        {
            $crt   = $request->correct;
            $opts   = $request->option;
            if ($crt != null) {

                foreach ($crt as $key => $value) {
                    $option = new Option;
                    $option->content = $opts[$value];
                    $option->status = 1;
                    $option->question_id = $question->id;
                    $option->save();
                    unset($opts[$value]);
                }
                foreach ($opts as $key => $value) {
                    $option = new Option;
                    $option->content = $value;
                    $option->status = 0;
                    $option->question_id = $question->id;
                    $option->save();
                }
            }
        }
        $question_id = $question->id;
        $testquestion = $this->testquestion;
        $testquestion->test_id = $id;
        $testquestion->question_id = $question_id;
        $testquestion->save();

        $gettestquestion = TestQuestion::where('test_id',$test['id'])->orderBy('id','DESC')->paginate(5);
        $array = [];
        foreach ($gettestquestion as $key => $value) {
            $array[]['question'] = $this->getQuestion($value['question_id']);
            $array[$key]['option'] = $this->getOption($value['question_id']);
        }

        return view('admin.test.view',compact('array','gettestquestion','test'));
    }
    public function saveQuestionofTest(Request $request, $id)
    {
        $test = $this->test->getTestByID($id);
        $test->timetotal = $request->timetotal;
        $test->expired   = $request->expired;
        $test->save();
        return redirect()->route('admin.test.getList')->with(['flash_messages'=>'Add new  Test success']);
    }
    public function delQuestionofTest($id)
    {
        $testquestion = TestQuestion::find($id);
        $testquestion->delete($id);
        return redirect()->back()->with(['flash_messages'=>'Delete question of Test success']);
    }
}
