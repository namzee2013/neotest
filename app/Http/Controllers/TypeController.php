<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TypeRequest;
use App\Type;

class TypeController extends Controller
{
	function __construct(Type $type)
	{
		$this->type = $type;
	}
    public function getList()
    {
    	$type = $this->type->getAllType();
    	return view('admin.type.list',compact('type'));
    }

    public function getAdd()
    {
    	return view('admin.type.add');
    }

    public function postAdd(TypeRequest $request)
    {
    	$type = $this->type;
    	$type->type = $request->type;
    	$type->save();
    	return redirect()->route('admin.type.getAdd')->with(['flash_messages' => 'Add Type success']);
    }

    public function getEdit($id)
    {
    	$type = $this->type->getTypeByID($id);
    	return view('admin.type.edit', compact('type'));
    }

    public function postEdit(TypeRequest $request, $id)
    {
    	$type = $this->type->getTypeByID($id);
    	$type->type = $request->type;
    	$type->save();
    	return redirect()->route('admin.type.getList')->with(['flash_messages' => 'Update Type success']);    	
    }

    public function getDelete($id)
    {
    	$type = $this->type->getTypeByID($id);
    	$type->delete($id);
    	return redirect()->route('admin.type.getList')->with(['flash_messages' => 'Delete Type success']);    	
    	
    }
}
