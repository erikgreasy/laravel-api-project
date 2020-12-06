<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Resources\Article as ArticleResource;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get articles
        $articles = Article::orderBy( 'created_at', 'desc' )->paginate( 5 );

        // Return the collection of articles as a resource
        return ArticleResource::collection( $articles );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $article = $request->isMethod( 'put' ) ? Article::findOrFail( $request->article_id ) : new Article;

        $article->id = $request->input( 'article_id' );
        $article->title = $request->input( 'title' );
        $article->body = $request->input( 'body' );

        if( $article->save() ) {
            return new ArticleResource( $article );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Get article
        $article = Article::findOrFail( $id );

        // Return single article as resource
        return new ArticleResource( $article );
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Get article
        $article = Article::findOrFail( $id );

        if( $article->delete() ) {
            return new ArticleResource( $article );
        }
    }
}
