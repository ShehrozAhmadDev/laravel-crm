<?php

namespace App\Http\Controllers\articles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleDetails extends Controller
{
  public function index($id)
  {
    $article = Article::findOrFail($id);
    return view('content.articles.article-details', compact('article'));
  }
}
