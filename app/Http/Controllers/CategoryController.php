<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Category;


class CategoryController extends Controller
{
    function __construct(Category $category)
    {
        $this->category = $category;
        $categoryselect = $this->category->getAllCategory();
        view()->share(['categoryselect' => $categoryselect]);
    }

    public function getList()
    {
    	$allcategory = $this->category->getAllCategory();
    	return view('admin.category.list',compact('allcategory'));
    }

    public function getAdd()
    {
        return view('admin.category.add');
    }


    public function postAdd(CategoryRequest $request)
    {
        $category = $this->category;
        $category->name        = $request->name;
        $category->save();

        return redirect()->route('admin.category.getAdd')->with(['flash_messages' => 'Add new Category success']);

    }

    public function getEdit($id)
    {
    	$category = $this->category->getCategoryByID($id);
    	return view('admin.category.edit',compact('category'));
    }

    public function postEdit(CategoryRequest $request, $id)
    {
    	$category = $this->category->getCategoryByID($id);
    	$category->name = $request->name;
    	$category->save();

    	return redirect()->route('admin.category.getList')->with(['flash_messages' => 'Update category success']);
    }

    public function getDelete($id)
    {
    	$category = $this->category->getCategoryByID($id);
    	$category->delete($id);

    	return redirect()->route('admin.category.getList')->with(['flash_messages' => 'Delete category success']);

    }

}
