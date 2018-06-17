<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticle;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
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
            $articles = Article::latest()->paginate(20);
            foreach($articles as $key => $article){
                $article['author'] = $article->author->name;
            }
        }
        else {
            $articles = [];
        }
        return view('admin.articles.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticle $request)
    {
        Article::saveArticle($request);

        return redirect('admin/articles')->with('success', 'Create successfully');
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
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        $this->validate(request(),[
           'title' => 'required',
           'content' => 'required'
        ]);
        $article->title = $request->get('title');
        $article->content = $request->get('content');
        $article->save();
//        Article::update($request->all());
        return redirect('articles')->with("success", "Update successfully!");
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
        $article->delete();
        return redirect('articles')->with('success', 'Delete successfully!');
    }
}
