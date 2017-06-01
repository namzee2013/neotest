<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB,Auth;
use App\User;
class UserController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function index()
  {
    $users = DB::table('users')->select('id','name','email','avatar')->get();
    return view('admin.user.index', compact('users'));
  }
  public function create()
  {
    if (Auth::user()->role->role === 'superadmin' || Auth::user()->role->role === 'admin') {
      $roles = DB::table('roles')->select('id','role')->where('role','<>', 'superadmin')->get();
      return view('admin.user.create', compact('roles'));
    }else {
      return redirect()->back()->with(['flash_level'=>'danger','flash_message'=>'Bạn không có quyền này!']);;
    }

  }
  public function store(Request $req)
  {
    $this->validate($req, [
      'role_id'=>'required',
      'name'=>'required',
      'email'=>'required|unique:users,email|email',
      'password'=>'required',
      'repassword'=>'required|same:password',
      'avatar'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

    if (Auth::user()->role->role === 'superadmin' || Auth::user()->role->role === 'admin') {
      $user = new User($req->all());
      $user->password = bcrypt($user->password);
      if ($req->file('avatar')) {
        $file = $req->file('avatar');
        $user->avatar = time().'.'.$file->getClientOriginalExtension();
        $destinationPath = public_path('uploads/avatars');
        $file->move($destinationPath, $user->avatar);
      }else {
        $user->avatar = null;
      }
      $user->save();
      return redirect()->route('admin.user')->with(['flash_level'=>'success','flash_message'=>'Thêm mới user: '.$req->email.' thành công!!']);

    }else {
      return redirect()->back()->with(['flash_level'=>'danger','flash_message'=>'Bạn không có quyền này!']);;
    }
  }
  public function edit($id)
  {
    if (Auth::user()->role->role === 'superadmin' || Auth::user()->role->role === 'admin') {
      $roles = DB::table('roles')->select('id','role')->get();
      $user = User::findOrFail($id);
      return view('admin.user.edit', compact('roles','user','id'));
    }else {
      return redirect()->back()->with(['flash_level'=>'danger','flash_message'=>'Bạn không có quyền này!']);;
    }

  }
  public function update($id, Request $req)
  {
    // $this->validate($req, [
    //   'role_id'=>'required',
    //   'name'=>'required',
    //   'email'=>'required|email',
    //   'password'=>'required',
    //   'repassword'=>'required|same:password',
    //   'avatar'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    // ]);
    if (Auth::user()->role->role === 'superadmin' || Auth::user()->role->role === 'admin') {
      $user = User::findOrFail($id);
      $user->role_id = $req->role_id;
      $user->name = $req->name;
      $user->email = $req->email;
      $user->password = bcrypt($req->password);
      if ($req->file('avatar')) {
        $curentAvatar = $user->avatar;
        $file = $req->file('avatar');
        $user->avatar = time().'.'.$file->getClientOriginalExtension();
        $destinationPath = public_path('uploads/avatars/');
        $file->move($destinationPath, $user->avatar);
        if ( $curentAvatar!== null && file_exists($destinationPath.$curentAvatar)) {
          unlink($destinationPath.$curentAvatar);
        }
      }
      $user->save();
      return redirect()->route('admin.user')->with(['flash_level'=>'success','flash_message'=>'Cập nhật user: '.$req->email.' thành công!!']);

    }else {
      return redirect()->back()->with(['flash_level'=>'danger','flash_message'=>'Bạn không có quyền này!']);;
    }

  }
  public function delete($id)
  {
    if (Auth::user()->role->role === 'superadmin' || Auth::user()->role->role === 'admin') {
      $user = User::findOrFail($id);
      $destinationPath = public_path('uploads/avatars/');
      if ($user->avatar !== null && file_exists($destinationPath.$user->avatar)) {
        unlink($destinationPath.$user->avatar);
      }
      $user->delete();
      return redirect()->route('admin.user')->with(['flash_level'=>'success','flash_message'=>'Xóa user: '.$user->email.' thành công!!']);
    }else {
      return redirect()->back()->with(['flash_level'=>'danger','flash_message'=>'Bạn không có quyền này!']);;
    }
  }
}
