<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\TestQuestion;
use App\Test;
class TestController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    public function index(){
      $tests = DB::table('tests')
      // ->join('questions','questions.id','=','test_questions.question_id')
      // ->join('tests','tests.id','=','test_questions.test_id')
      ->select('id','expired','link','timetotal','total_mark')
      // ->where('total_mark', '=', null)
      ->get();
      // dd($tests);
      return view('admin.test.mark.index',compact('tests'));
    }
    private function getOption($question_id)
    {
      return DB::table('options')
              ->select('id','content','status')
              ->where('question_id','=',$question_id)
              ->get();
    }
    public function setMark($id)
    {
      $data = DB::table('test_questions')
              ->join('questions','questions.id','=','test_questions.question_id')
              ->join('types','types.id','=','questions.type_id')
              ->select('test_questions.id','type','question_id','title','test_questions.mark_max')
              ->where('test_questions.test_id','=',$id)
              ->get();
      foreach ($data as $key => $value) {
        $value->options = $this->getOption($value->question_id);
      }
      // dd($data);
      return view('admin.test.mark.setmark', compact('id','data'));

    }

    public function setMarkQuestion(Request $req, $id)
    {
      if ($req->ajax()) {
        $test_questions = TestQuestion::find($req->id);
        $test = Test::find($req->test_id);
        $test->total_mark = $test->total_mark - $test_questions->mark_max + (int)$req->mark;
        $test->save();

        $test_questions->mark_max = (int)$req->mark;
        $test_questions->save();

        return 'success';
      }
    }
    public function setMarkAll(Request $req)
    {
      if ($req->ajax()) {
        $data = TestQuestion::where('test_id', $req->test_id)->get();
        $sum = 0;
        foreach ($data as $key => $value) {
          $value->mark_max = $req->mark;
          $value->save();
          $sum += $req->mark;
        }
        $test = Test::find($req->test_id);
        $test->total_mark = $sum;
        $test->save();
        return 'success';
      }
    }
    public function getSumMark(Request $req)
    {
      if ($req->ajax()) {

        $data = Test::find($req->test_id)->total_mark;
        return $data;
      }
    }
}
