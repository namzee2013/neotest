<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rate;
use App\Category;
class RateController extends Controller
{
    public function index()
    {
      $rates = Rate::with('category')->get();
      $cates = Category::all();
      return view('admin.rate.index',compact('rates','cates'));
    }
    public function create()
    {
      $cates = Category::all();
      return view('admin.rate.create',compact('cates'));
    }
    public function store(Request $req)
    {
      $this->validate($req, [
        'label'=>'required',
        'index1'=>'numeric|min:0|max:1',
        'index2'=>'numeric|min:0|max:1',
        'color'=>'required',
        'category_id'=>'required'
      ]);
      // print_r($req->all());
      Rate::create($req->all());
      return redirect()->route('admin.rate')->with(['flash_level'=>'success','flash_message'=>'Thêm mới rate: '.$req->label.' thành công!!']);
    }
    public function edit($id)
    {
      $rate = Rate::findOrFail($id);
      $cates = Category::all();
      return view('admin.rate.edit', compact('rate','id','cates'));
    }
    public function update($id,Request $req)
    {
      $this->validate($req, [
        'label'=>'required',
        'index1'=>'numeric|min:0|max:1',
        'index2'=>'numeric|min:0|max:1',
        'color'=>'required',
        'category_id'=>'required'
      ]);

      $rate = Rate::findOrFail($id);
      $rate->label = $req->label;
      $rate->index1 = (float)$req->index1;
      $rate->index2 = (float)$req->index2;
      $rate->color = $req->color;
      $rate->category_id = $req->category_id;
      $rate->save();
      return redirect()->route('admin.rate')->with(['flash_level'=>'success','flash_message'=>'Cập nhật rate: '.$req->label.' thành công!!']);

    }
    public function delete($id)
    {
      $rate = Rate::findOrFail($id);
      $rate->delete();
      return redirect()->route('admin.rate')->with(['flash_level'=>'success','flash_message'=>'Xóa role: '.$rate->label.' thành công!!']);
    }
    public function getByCategory(Request $req)
    {
      if ($req->ajax()) {
        if ((int)$req->id === 0) {
          return Rate::with('category')->get();
        }else {
          return Rate::with('category')->where('category_id',$req->id)->get();
        }
      }
    }
}
