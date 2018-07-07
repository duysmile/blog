<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\ArticleStatus;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticle;
use App\Http\Requests\StoreImage;
use App\Http\Requests\UpdateArticle;
use DeepCopy\f008\A;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('status');
        return $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Article::count()){
//            show all article even if deleted articles
//            $articles = Article::withTrashed()->latest()->paginate(3);
//            show only deleted articles
//            $articles = Article::onlyTrashed()->latest()->paginate(3);
//            to undelete article use
//            $articles->restore();
            if(Auth::user()->roles[0]->name == 'admin'){
                $articles = Article::getArticles();
            }
            else{
                $articles = Article::getArticlesByAuthor(Auth::user()->id);
            }
        }
        else {
            $articles = [];
        }
        $statuses = ArticleStatus::all();
        $categories = Category::all();
        return view('admin.articles.index', ['articles' => $articles , 'statuses' => $statuses, 'categories' => $categories]);
    }
    public function search(Request $query)
    {
        if(Auth::user()->roles[0]->name == 'admin'){
            $articles = Article::searchFullText($query);
        }
        else{
            $articles = Article::searchFullTextForAuthor($query, Auth::user()->id);
        }
        $statuses = ArticleStatus::all();
        $categories = Category::all();
        return view('admin.articles.index', ['articles' => $articles , 'statuses' => $statuses, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::getCategory();
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticle $request)
    {
        $thumbnail = new StoreImage(['image' => $request->thumbnail]);

        if(Article::saveArticle($request)){
            return redirect('admin/articles')->with('success', 'Create successfully');
        }
        else{
            return redirect('admin.articles.create')->with('error', 'Please check your input!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        $article->id_author = Article::find($id)->author;
        return view('articles.show', compact('article'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        $article_category = Article::getCategories($article);
        if(Auth::user()->roles[0]->name != 'admin' && Auth::user()->id !== $article->author->id){
            return redirect('admin/articles')->with('error', 'Cannot edit this article because it is not yours.');
        }
        $categories = Category::getCategory();
        return view('admin.articles.edit', ['article' => $article, 'categories' => $categories, 'article_category' => $article_category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticle $request, $id)
    {
        $article = Article::find($id);
        if(Auth::user()->id !== $article->author->id){
            return redirect('admin/articles')->with('error', 'Cannot edit this article because it is not yours.');
        }
        $this->validate($request, [
            'title' => 'unique:articles,title,'. $id .',id,deleted_at,NULL',
        ]);
        if(Article::updateArticle($id, $request)){
            return redirect('admin/articles')->with("success", "Update successfully!");
        }
        return redirect('admin/articles')->with("error", "Something wrong!");
    }
    public function updateStatus(Request $request)
    {
        if(Article::updateArticleStatus($request->getContent())){
            return response()->json([
                'status' => 'true',
            ]);
        }
        return response()->json([
            'status' => 'false',
        ]);
    }
    public function updateTop(Request $request)
    {
        if(Article::updateArticleTop($request->getContent())){
            return response()->json([
                'status' => 'true',
            ]);
        }
        return response()->json([
            'status' => 'false',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);

        if(Auth::user()->roles[0]->name != 'admin' && Auth::user()->id !== $article->author->id){
            return redirect('admin/articles')->with('error', 'Cannot delete this article because it is not yours.');
        }
        $article->delete();
        return redirect('admin/articles')->with('success', 'Delete successfully!');
    }
}
