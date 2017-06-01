<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Test;
use App\UserTest;
use App\Rate;
class HomeController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  private function countTest($category_id)
  {
    return Test::where('category_id',$category_id)->get();
  }
  public function getCountTest(Request $req)
  {
    if ($req->ajax()) {
      $data = Category::all()->toArray();
      foreach ($data as $key => $value) {
        $value['label'] = $value['name'];
        $value['value'] = $this->countTest($value['id'])->count();
        $data[$key] = $value;
      }
      return $data;
    }
  }
  private function CountUserTest($test_id)
  {
    return UserTest::where('test_id', $test_id)->get()->count();
  }
  public function getCountUserTest(Request $req)
  {
    if ($req->ajax()) {
      $data = Category::all()->toArray();
      foreach ($data as $key => $value) {
        $value['label'] = $value['name'];
        $tests = $this->countTest($value['id']);
        $count = 0;
        foreach ($tests as $keyT => $valueT) {
          $count += $this->CountUserTest($valueT['id']);
        }
        $value['value'] = $count;
        $data[$key] = $value;
      }
      return $data;
    }
  }
  private function countTestWithMark($index1,$index2)
  {
    $data = 0;
    $tests = Test::where('total_mark','<>', null)->get()->toArray();
    foreach ($tests as $key => $value) {
      $temp = UserTest::where('test_id', $value['id'])->where('mark','<>',null)->get()->toArray();
      foreach ($temp as $keyT => $valueT) {
        if ($index1 <= $valueT['mark']/$value['total_mark'] && $valueT['mark']/$value['total_mark'] < $index2) {
          $data++;
        }
      }
    }
    return $data;
  }
  private function getRate()
  {
    return Rate::with('category')->get();
  }
  public function getCountTestWithMark(Request $req)
  {
    if ($req->ajax()) {

      $data = $this->getRate();
      foreach ($data as $key => $value) {
        $value->label = $value->category->name . ' - ' . $value->label;
        $value->value = $this->countTestWithMark($value->index1,$value->index2);
        $data[$key] = $value;
      }
      return $data;
    }
  }
  public function index()
  {

    return view('admin.home');
  }
}
