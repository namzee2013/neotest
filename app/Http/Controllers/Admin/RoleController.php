<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Role;
use App\User;
use Auth;
class RoleController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function index()
  {
    $roles = DB::table('roles')->select('id','role')->get();
    return view('admin.role.index', compact('roles'));
  }

  public function create()
  {
    if (Auth::user()->role->role === 'superadmin' || Auth::user()->role->role === 'admin') {
      return view('admin.role.create');
    }else {
      return redirect()->back()->with(['flash_level'=>'danger','flash_message'=>'Bạn không có quyền này!']);;
    }

  }

  public function store(Request $req)
  {
    if (Auth::user()->role->role === 'superadmin' || Auth::user()->role->role === 'admin') {
      $this->validate($req, [
        'role'=>'required|unique:roles,role'
      ]);
      Role::create($req->all());
      return redirect()->route('admin.role')->with(['flash_level'=>'success','flash_message'=>'Thêm mới role: '.$req->role.' thành công!!']);
    }else {
      return redirect()->back()->with(['flash_level'=>'danger','flash_message'=>'Bạn không có quyền này!']);;
    }
  }

  public function edit($id)
  {
    if (Auth::user()->role->role === 'superadmin' || Auth::user()->role->role === 'admin') {
      $role = Role::findOrFail($id);
      return view('admin.role.edit', compact('role','id'));
    }else {
      return redirect()->back()->with(['flash_level'=>'danger','flash_message'=>'Bạn không có quyền này!']);;
    }

  }

  public function update($id, Request $req)
  {
    $this->validate($req, [
      'role'=>'required'
    ]);
    if (Auth::user()->role->role === 'superadmin' || Auth::user()->role->role === 'admin') {
      $role = Role::findOrFail($id);
      $role->role = $req->role;
      $role->save();
      return redirect()->route('admin.role')->with(['flash_level'=>'success','flash_message'=>'Cập nhật role: '.$req->role.' thành công!!']);

    }else {
      return redirect()->back()->with(['flash_level'=>'danger','flash_message'=>'Bạn không có quyền này!']);;
    }


  }

  public function delete($id)
  {
    if (Auth::user()->role->role === 'superadmin' || Auth::user()->role->role === 'admin') {
      $role = Role::findOrFail($id);
      $role->delete();
      return redirect()->route('admin.role')->with(['flash_level'=>'success','flash_message'=>'Xóa role: '.$role->role.' thành công!!']);

    }else {
      return redirect()->back()->with(['flash_level'=>'danger','flash_message'=>'Bạn không có quyền này!']);;
    }

  }
}
