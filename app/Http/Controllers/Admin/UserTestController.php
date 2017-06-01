<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\UserTest;
use App\TestQuestion;
use App\Test;
use App\UserTestResult;
use App\Rate;
use App\Category;
class UserTestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function getRate()
    {
      return Rate::all();
    }

    public function getAllByCategory(Request $req)
    {
      if ($req->ajax()) {
        if ((int)$req->id === 0) {
          $rates = Rate::all();
          $tests = DB::table('user_tests')
                  ->join('tests','tests.id','=','user_tests.test_id')
                  ->join('users','users.id','=','user_tests.user_id')
                  ->select('user_tests.id as id','mark','timespend','timetotal','name','email','total_mark','tests.category_id')
                  ->get();
          foreach ($tests as $key => $value) {
            if ($value->mark !== null && $value->total_mark !== null) {
              $value->averagemark = (float)number_format($value->mark / $value->total_mark,1);
              if (count($rates)>0) {
                foreach ($rates as $keyR => $valueR) {
                  if ($valueR->index1 <= $value->averagemark && $value->averagemark <= $valueR->index2 && $value->category_id === $valueR->category_id) {
                    $value->color = $valueR->color;
                  }
                }
              }else {
                $value->color = '';
              }
            }
          }
          return $tests;
        }else {
          $id = $req->id;
          $rates = Rate::where('category_id', $id)->get();
          $tests = DB::table('user_tests')
                  ->join('tests','tests.id','=','user_tests.test_id')
                  ->join('users','users.id','=','user_tests.user_id')
                  ->where('tests.category_id', $id)
                  ->select('user_tests.id as id','mark','timespend','timetotal','name','email','total_mark')
                  ->get();
          foreach ($tests as $key => $value) {
            if ($value->mark !== null && $value->total_mark !== null) {
              $value->averagemark = (float)number_format($value->mark / $value->total_mark,1);
              if (count($rates)>0) {
                foreach ($rates as $keyR => $valueR) {
                  if ($valueR->index1 <= $value->averagemark && $value->averagemark <= $valueR->index2) {
                    $value->color = $valueR->color;
                  }
                }
              }else {
                $value->color = '';
              }
            }
          }
          return $tests;
        }

      }
    }
    public function getAll()
    {
      $cates = Category::all();
      $rates = $this->getRate();
      $tests = DB::table('user_tests')
              ->join('tests','tests.id','=','user_tests.test_id')
              ->join('users','users.id','=','user_tests.user_id')
              ->select('user_tests.id as id','mark','timespend','timetotal','name','email','total_mark','tests.category_id')
              ->get();

      foreach ($tests as $key => $value) {
        $value->color = '';
        if ($value->mark !== null && $value->total_mark !== null) {
          $value->averagemark = (float)number_format($value->mark / $value->total_mark,1);
          if (count($rates)>0) {
            foreach ($rates as $keyR => $valueR) {
              if ($valueR->index1 <= $value->averagemark && $value->averagemark <= $valueR->index2 && $value->category_id === $valueR->category_id) {
                $value->color = $valueR->color;
              }
            }
          }

        }
      }
      // dd($tests);

      return view('admin.test.all', compact('tests','rates','cates'));
    }
    public function getNotMarkedByCategory(Request $req)
    {
      if ($req->ajax()) {
        if ((int)$req->id === 0) {
          $rates = Rate::all();
          $tests = DB::table('user_tests')
                  ->join('tests','tests.id','=','user_tests.test_id')
                  ->join('users','users.id','=','user_tests.user_id')
                  ->where('mark','=',null)
                  ->select('user_tests.id as id','mark','timespend','timetotal','name','email','total_mark')
                  ->get();
          return $tests;
        }else {
          $id = $req->id;
          $rates = Rate::where('category_id', $id)->get();
          $tests = DB::table('user_tests')
                  ->join('tests','tests.id','=','user_tests.test_id')
                  ->join('users','users.id','=','user_tests.user_id')
                  ->where('tests.category_id', $id)
                  ->where('mark','=',null)
                  ->select('user_tests.id as id','mark','timespend','timetotal','name','email','total_mark')
                  ->get();
          return $tests;
        }

      }
    }
    public function getNotMarked()
    {
      $cates = Category::all();
      $rates = $this->getRate();
      $tests = DB::table('user_tests')
              ->join('tests','tests.id','=','user_tests.test_id')
              ->join('users','users.id','=','user_tests.user_id')
              ->select('user_tests.id as id','mark','timespend','timetotal','name','email','total_mark')
              ->where('mark','=',null)
              ->get();
      // dd($tests);
      return view('admin.test.notmarked', compact('tests','rates','cates'));
    }
    public function getMarkedByCategory(Request $req)
    {
      if ($req->ajax()) {
        if ((int)$req->id === 0) {
          $rates = Rate::all();
          $tests = DB::table('user_tests')
                  ->join('tests','tests.id','=','user_tests.test_id')
                  ->join('users','users.id','=','user_tests.user_id')
                  ->where('mark','<>',null)
                  ->select('user_tests.id as id','mark','timespend','timetotal','name','email','total_mark','tests.category_id')
                  ->get();
          foreach ($tests as $key => $value) {
            if ($value->mark !== null && $value->total_mark !== null) {
              $value->averagemark = (float)number_format($value->mark / $value->total_mark,1);
              if (count($rates)>0) {
                foreach ($rates as $keyR => $valueR) {
                  if ($valueR->index1 <= $value->averagemark && $value->averagemark <= $valueR->index2 && $value->category_id === $valueR->category_id) {
                    $value->color = $valueR->color;
                  }
                }
              }else {
                $value->color = '';
              }
            }
          }
          return $tests;
        }else {
          $id = $req->id;
          $rates = Rate::where('category_id', $id)->get();
          $tests = DB::table('user_tests')
                  ->join('tests','tests.id','=','user_tests.test_id')
                  ->join('users','users.id','=','user_tests.user_id')
                  ->where('tests.category_id', $id)
                  ->where('mark','<>',null)
                  ->select('user_tests.id as id','mark','timespend','timetotal','name','email','total_mark')
                  ->get();
          foreach ($tests as $key => $value) {
            if ($value->mark !== null && $value->total_mark !== null) {
              $value->averagemark = (float)number_format($value->mark / $value->total_mark,1);
              if (count($rates)>0) {
                foreach ($rates as $keyR => $valueR) {
                  if ($valueR->index1 <= $value->averagemark && $value->averagemark <= $valueR->index2) {
                    $value->color = $valueR->color;
                  }
                }
              }else {
                $value->color = '';
              }
            }
          }
          return $tests;
        }

      }
    }
    public function getMarked()
    {
      $rates = $this->getRate();
      $cates = Category::all();

      $tests = DB::table('user_tests')
              ->join('tests','tests.id','=','user_tests.test_id')
              ->join('users','users.id','=','user_tests.user_id')
              ->select('user_tests.id as id','mark','timespend','timetotal','name','email','total_mark','tests.category_id')
              ->where('mark','<>',null)
              ->get();
      foreach ($tests as $key => $value) {
        $value->color = '';
        if ($value->mark !== null && $value->total_mark !== null) {
          $value->averagemark = (float)number_format($value->mark / $value->total_mark,1);
          if (count($rates) > 0) {
            foreach ($rates as $keyR => $valueR) {
              if ($valueR->index1 <= $value->averagemark && $value->averagemark <= $valueR->index2 && $value->category_id === $valueR->category_id) {
                $value->color = $valueR->color;
              }
            }
          }

        }
      }

      return view('admin.test.marked', compact('tests','colors','rates','cates'));
    }
    private function getOption($question_id)
    {
      return DB::table('options')
              ->select('id','content','status')
              ->where('question_id','=',$question_id)
              ->get();
    }
    private function getMarkMax($question_id){
      $data = DB::table('test_questions')->select('mark_max')->where('question_id','=',$question_id)->first()->mark_max;
      if ($data === null) {
        return 10;
      }else {
        return $data;
      }
    }
    private function getQuestion($question_id)
    {
      $data = DB::table('questions')
              ->join('types','types.id','=','questions.type_id')
              ->select('type','title')
              ->where('questions.id','=',$question_id)
              ->get()->first();
      $data->options = $this->getOption($question_id);
      $data->mark_max = $this->getMarkMax($question_id);
      return $data;

    }
    public function editMark($id)
    {
      $characters = [
        0=>'A',1=>'B',2=>'C',3=>'D',4=>'E',5=>'F',6=>'G',7=>'H',8=>'I',9=>'J',10=>'K',11=>'L',12=>'M',
      ];
      $data = DB::table('user_test_results')
              ->select('id','question_id','result','comment')
              ->where('usertest_id','=',$id)
              ->get();

      $user_tests = DB::table('user_tests')->select('test_id','mark')->where('id','=',$id)->get()->first();
      $total = $user_tests->mark;
      if ($total === null) {
        $total = 0;
      }
      $marktrue = 0;
      foreach ($data as $key => $value) {
        $value = (object) array_merge((array) $value, (array) $this->getQuestion($value->question_id));

        if ($value->type === 'single') {
          // $value->result = (int)$value->result;
          $value->result = json_decode($value->result)[0];
          foreach ($value->options as $keyOpt => $valueOpt) {
            if ($valueOpt->status === 1 && $value->result === $valueOpt->id) {
              $value->status = true;
              $marktrue += $value->mark_max;
            }
          }
          if (!isset($value->status)) {
            $value->status = false;
          }
        }elseif ($value->type === 'multiple') {
          $value->resultArr = json_decode($value->result);
          $status = 0;
          foreach ($value->options as $keyOpt => $valueOpt) {
            foreach ($value->resultArr as $keyR => $valueR) {
              if ($valueOpt->status === 1 && $valueOpt->id === $valueR) {
                $status++;
              }
            }

          }
          if ($status === count($value->resultArr)) {
            $value->status = true;
            $marktrue += $value->mark_max;
          }else {
            $value->status = false;
          }
        }else {
          $value->result = substr($value->result,1,strlen($value->result)-2);
          $value->status = false;
          if ($value->comment !== null) {
            $comment = json_decode($value->comment);
            $value->diem = $comment->diem;
            $value->comment = $comment->comment;
          }

        }
        $data[$key] = $value;
      }

      $totalmark = Test::find($user_tests->test_id)->get()->first()->total_mark;
      // dd($data);
      if ($totalmark === null) {
        $totalmark = count($data) * 10;
      }
      return view('admin.test.editmark', compact('data','id','total','characters','totalmark','marktrue'));
    }

    public function marked(Request $req)
    {
      if ($req->ajax()) {
        $id = (int)$req->id;
        $mark = (int)$req->mark;

        $data = UserTest::find($id);
        $data->mark = $mark;
        $data->updated_at = date('Y-m-d H:i:s');
        $data->save();
        return 'success';
      }
    }
    public function updateComment(Request $req)
    {
      if ($req->ajax()) {
        $data = $req->all();
        $id = $req->id;
        $data['diem'] = (int)$data['diem'];
        unset($data['_']);
        unset($data['id']);
        $utr = UserTestResult::find($id);
        $utr->comment = json_encode($data);
        $utr->save();
        return 'success';
      }
    }
}
