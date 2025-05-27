<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class ArticleController extends Controller implements HasMiddleware 
{
    public static function middleware(): array {
        return [
            new Middleware('permission:view articles', only: ['index']),
            new Middleware('permission:edit articles', only: ['edit']),
            new Middleware('permission:create articles', only: ['create']),
            new Middleware('permission:delete articles', only: ['destroy']),
        ];
    }
    // This method will display all articles
    public function index() {
        $articles= Article::latest()->paginate(10);
        return view('articles.list',['articles'=>$articles]);
    }

    // This method will create a new article
    public function create() {
      return view('articles.create');
    }

    // This method will insert new article in the database
    public function store(Request $request) {
        $validated = Validator::make($request->all(),[
            'title'=>'required|min:5',
            "text"=>'required',
            "author"=>'required',
        ]);
        if($validated->passes()) {
         $article = new Article();
         $article->title = $request->title;
         $article->text = $request->text;
         $article->author = $request->author;
         $article->save();
         return redirect()->route('articles.index')->with('success','Article Saved Successflly!');
        } else {
            return redirect()->route('articles.create')->withInput()->withErrors($validated);
        }
    }

    //This method will edit the already article 
    public function edit($id) {
        $article = Article::findOrFail($id);
        //return view('articles.edit',compact('article'));
        return view('articles.edit',['article'=>$article]);
    }

    // This method will udated the existed article 
    public function update($id, Request $request) {
        $article = Article::findOrFail($id);
        $validated = Validator::make($request->all(),[
            'title'=>'required',
            'text'=>'required',
            'author'=>'required'
        ]);
        if($validated->passes()) {
            $article->title = $request->title;
            $article->text = $request->text;    
            $article->author = $request->author;
            $article->save();
            return redirect()->route('articles.index')->with("success",'Article Updated Successfully');
        }else {
            return redirect()->route('articles.edit',$id)->withInput()->withErrors($validated);
        }

    }

    // This method will delete the article 
    public function destroy(Request $request) {
        $article = Article::find($request->id);
        if($artile == null) {
            session()->flash('error','Article Not Found');
            return response()->json([
                "status"=> false
            ]);
        }
        $article->delete();
        session()->flash("success","Article Delete Successfully!");
        return response()->json([
            "status"=>true
        ]);
    }
}
