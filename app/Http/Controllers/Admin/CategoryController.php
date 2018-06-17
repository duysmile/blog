<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
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
        return redirect('admin/categories');
    }
    public function edit($categoryId){
        $category = Category::find($categoryId);
        $categoryParent = Category::whereNull('id_parent')->get();
        return view('admin.categories.edit', [
            'category' => $category,
            'categoryParent' => $categoryParent,
        ]);
    }
    public function update(StoreCategory $category, $id){
        Category::updateCategory($category, $id);
        return redirect('admin/categories')->with("success", "Update successfully!");
    }
    public function show(){
        return view('admin/categories/show');
    }
    public function destroy($categoryId){
        $category = Category::find($categoryId);
        $category->delete();
        return redirect('admin/categories')->with("success", "Delete successfully");
    }
}
