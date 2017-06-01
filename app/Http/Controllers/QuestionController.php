<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Category;
use App\Type;
use App\Option;
use Auth;
use App\Http\Requests\QuestionRequest;


class QuestionController extends Controller
{
    function __construct(Question $question, Category $category, Type $type, Option $option)
    {
        $this->question = $question;
        $this->option   = $option;
        $this->category = $category;
        $this->type     = $type;
        $categoryselect = $this->category->getAllCategory();
        $typeselect     = $this->type->getAllType();
        view()->share(['categoryselect' => $categoryselect, 'typeselect' => $typeselect]);
    }

    public function getList()
    {
    	$question = $this->question->getAllQuestion();
    	return view('admin.question.list', compact('question'));
    }

    public function getChoose()
    {
    	return view('admin.question.choosetype');
    }
    public function valid()
    {
        $type = $this->type->getAllType();
        return view('admin.question.valid',compact('type'));
    }


    public function postAddOneChoiceQuest(QuestionRequest $request)
    {
        $question = $this->question;
        $question->title = $request->question;
        $question->category_id  = $request->category_id;
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
        $question_id = $question->id;
        $option = [];

        $opts = $request->option;
        $corr = $request->correct;
        if($corr != null)
        {
            array_push($option,[
                'content' => $opts[$corr],
                'status'  => 1,
                'question_id' => $question_id
            ]); 
            unset($opts[$corr]);
            foreach ($opts as $key => $value) {
                array_push($option,[
                    'content' => $value,
                    'status'  => 0,
                    'question_id' => $question_id
                ]);
            }

        }
        shuffle($option);
        foreach ($option as $key => $item) {
            $option = new Option; 
            $option->content = $item['content'];
            $option->status = $item['status'];
            $option->question_id = $item['question_id'];
            $option->save();
        }
        return redirect()->route('admin.question.addQuestion')->with(['flash_messages'=>'Add question success']);
    }


    public function postAddMultiChoiceQuest(QuestionRequest $request)
    {
        $question = $this->question;
        $question->title = $request->question;
        $question->category_id  = $request->category_id;
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
        $question_id = $question->id;
        $crt   = $request->correct;
        $opts   = $request->option;
        $option = [];
        if ($crt != null) {
            
            foreach ($crt as $key => $value) {  
                array_push($option,[
                    'content' => $opts[$value],
                    'status'  => 1,
                    'question_id' => $question_id
                ]); 

                unset($opts[$value]);  
            }
            foreach ($opts as $key => $value) {  
                array_push($option,[
                    'content' => $value,
                    'status'  => 0,
                    'question_id' => $question_id
                ]);
            }
        }
        shuffle($option);
        foreach ($option as $key => $item) {
            $option = new Option; 
            $option->content = $item['content'];
            $option->status = $item['status'];
            $option->question_id = $item['question_id'];
            $option->save();
        }
        return redirect()->route('admin.question.addQuestion')->with(['flash_messages'=>'Add question success']);
    }


    public function postAddTextQuest(QuestionRequest $request)
    {
        $question = $this->question;
        $question->title = $request->question;
        $question->category_id  = $request->category_id;
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
        
        return redirect()->route('admin.question.addQuestion')->with(['flash_messages'=>'Add question success']);
    }
    public function getEdit($id)
    {
        $question = $this->question->getQuestionByID($id);
        $option   = $this->option::select()->where('question_id',$id)->get()->toArray();
        if ($question->type_id == 1) {
            return view('admin.question.edit-radio-quest', compact('question','option'));
        } elseif($question->type_id == 2) {
            return view('admin.question.edit-check-quest', compact('question','option'));
        }else{
            return view('admin.question.edit-text-quest', compact('question','option'));
        }
    }
    public function postEditRadioQuest(Request $request, $id)
    {
        $question = $this->question->getQuestionByID($id);
        $question->title = $request->question;
        $question->category_id  = $request->category_id;
        $question->user_id = Auth::user()->id;
        // $question->type_id = 1;
        $question->save();


        $correct = $request->correct;
        $option_id   = $request->option_id;
        $opts   = $request->option;
        if($correct != null)
        {
            $option = Option::find($correct); 
            $option->content = $opts[$correct];
            $option->status = 1;
            $option->question_id = $id;
            $option->save();
            unset($opts[$correct]);
            unset($option_id[$correct]);
            foreach ($option_id as $key => $value) {
                $option = Option::find($value); 
                $option->content = $opts[$value];
                $option->status = 0;
                $option->question_id = $id;
                $option->save();
                unset($opts[$value]);
            }
            if(count($opts) > 0)
            {
                foreach ($opts as $key => $item) {                
                    $option = new Option; 
                    $option->content = $item;
                    $option->status = 0;
                    $option->question_id = $question->id;
                    $option->save();
                }                
            }

        }
        return redirect()->route('admin.question.getList')->with(['flash_messages'=>'Update question success']);
    }
    public function postEditCheckQuest(Request $request, $id)
    {
        $question = $this->question->getQuestionByID($id);
        $question->title = $request->question;
        $question->category_id  = $request->category_id;
        $question->user_id = Auth::user()->id;
        // $question->type_id = 1;
        $question->save();


        $correct = $request->correct;
        $newcorrect = $request->newcorrect;
        $option_id   = $request->option_id;
        $opts   = $request->option;
        if($correct != null)
        {
            foreach ($correct as $key => $crt) {
                $option = Option::find($crt); 
                $option->content = $opts[$crt];
                $option->status = 1;
                $option->question_id = $id;
                $option->save();
                unset($opts[$crt]);
                unset($option_id[$crt]);
            }
            foreach ($option_id as $key => $value) {
                $option = Option::find($value); 
                $option->content = $opts[$value];
                $option->status = 0;
                $option->question_id = $id;
                $option->save();
                unset($opts[$value]);
            }
            if(count($opts) > 0)
            {
                if(count($newcorrect) > 0)
                {
                    foreach ($newcorrect as $key => $item) {
                        $option = new Option; 
                        $option->content = $opts[$item];
                        $option->status = 1;
                        $option->question_id = $id;
                        $option->save();
                        unset($opts[$item]);
                    }
                }
                else{                    
                    foreach ($opts as $key => $item) {                
                        $option = new Option; 
                        $option->content = $item;
                        $option->status = 0;
                        $option->question_id = $question->id;
                        $option->save();
                    }   
                }             
            }

        }
        return redirect()->route('admin.question.getList')->with(['flash_messages'=>'Update question success']);

    }
    public function postEditTextQuest(QuestionRequest $request, $id)
    {
        $question = $this->question->getQuestionByID($id);
        $question->title = $request->question;
        $question->category_id  = $request->category_id;
        $question->user_id = Auth::user()->id;
        // $question->type_id = 3;
        $question->save();

        $correct = Option::select()->where('question_id',$id)->first();
        $correct->content = $request->answer;
        $correct->status = 1;
        $correct->question_id = $question->id;
        $correct->save();
        
        return redirect()->route('admin.question.getList')->with(['flash_messages'=>'Update question success']);
    }
    public function deleteOption($id)
    {
        $option = Option::find($id);
        $option->delete($id);
        return redirect()->back();
    }
    public function deleteQuestion($id)
    {
        $question = $this->question->getQuestionByID($id);
        $question->delete($id);

        return redirect()->route('admin.question.getList')->with(['flash_messages'=>'Delete question success']);
    }
    public function addQuestion()
    {
        $type = $this->type->getAllType();
        return view('admin.question.add',compact('type'));
    }
}
