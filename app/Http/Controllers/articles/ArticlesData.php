<?php

namespace App\Http\Controllers\articles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article; 


class ArticlesData extends Controller
{
  public function index()
  {
    $articles = Article::all();
    $categories = $articles->pluck('category')->unique();

    return view('content.articles.articles', compact('articles', 'categories'));  }
    public function table()
  {
    $articles = Article::all();
    $categories = $articles->pluck('category')->unique();

    return view('content.tables.tables-basic', compact('articles', 'categories'));  }
}
