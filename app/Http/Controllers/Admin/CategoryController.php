<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategory;
use App\Http\Requests\UpdateCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('status');
        return $this->middleware(['auth']);
    }

    public function index(){
        $categories = Category::getCategory();
        return view('admin.categories.index', ['categories' => $categories]);
    }

    public function create(){
        $categoryParent = Category::whereNull('id_parent')->get();
        return view('admin.categories.create', compact('categoryParent'));
    }
    public function store(StoreCategory $request){
        Category::saveCategory($request);
        return redirect('admin/categories')->with('success', 'Create category successfully!');
    }
    public function edit($categoryId){
        $category = Category::find($categoryId);
        $categoryParent = Category::whereNull('id_parent')->get();
        return view('admin.categories.edit', [
            'category' => $category,
            'categoryParent' => $categoryParent,
        ]);
    }
    public function update(UpdateCategory $category, $id){
        $this->validate($category,[
           'name' => 'unique:categories,name,'. $id .',id,deleted_at,NULL',
        ]);
        Category::updateCategory($category, $id);
        return redirect('admin/categories')->with("success", "Update successfully!");
    }
    public function destroy($categoryId){
        $category = Category::find($categoryId);
        $category->delete();
        return redirect('admin/categories')->with("success", "Delete successfully");
    }
}
