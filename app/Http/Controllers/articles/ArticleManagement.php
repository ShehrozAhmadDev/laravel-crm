<?php

namespace App\Http\Controllers\articles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Str;

class ArticleManagement extends Controller
{
  /**
   * Redirect to user-management view.
   *
   */
  public function ArticleManagement()
  {
    $article = Article::all();
    // $userCount = $users->count();
    // $verified = User::whereNotNull('email_verified_at')->get()->count();
    // $notVerified = User::whereNull('email_verified_at')->get()->count();
    // $usersUnique = $users->unique(['email']);
    // $userDuplicates = $users->diff($usersUnique)->count();

    return view('content.articles.articles-table');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $columns = [
      1 => 'id',
      2 => 'title',
      3 => 'content',
      4 => 'category',
      5 => 'is_active',
      6 => 'created_at',
      7 => 'updated_at',
    ];

    $search = [];

    $totalData = Article::count();

    $totalFiltered = $totalData;

    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');

    if (empty($request->input('search.value'))) {
      $articles = Article::offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();
    } else {
      $search = $request->input('search.value');

      $articles = Article::where('id', 'LIKE', "%{$search}%")
        ->orWhere('title', 'LIKE', "%{$search}%")
        ->orWhere('category', 'LIKE', "%{$search}%")
        ->offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();

      $totalFiltered = Article::where('id', 'LIKE', "%{$search}%")
        ->orWhere('title', 'LIKE', "%{$search}%")
        ->orWhere('category', 'LIKE', "%{$search}%")
        ->count();
    }

    $data = [];

    if (!empty($articles)) {
      // providing a dummy id instead of database ids
      $ids = $start;

      foreach ($articles as $article) {
        $nestedData['id'] = $article->id;
        $nestedData['fake_id'] = ++$ids;
        $nestedData['title'] = $article->title;
        $nestedData['content'] = $article->content;
        $nestedData['category'] = $article->category;
        $nestedData['is_active'] = $article->is_active;
        $nestedData['created_at'] = $article->created_at;
        $nestedData['updated_at'] = $article->updated_at;
        $data[] = $nestedData;
      }
    }

    if ($data) {
      return response()->json([
        'draw' => intval($request->input('draw')),
        'recordsTotal' => intval($totalData),
        'recordsFiltered' => intval($totalFiltered),
        'code' => 200,
        'data' => $data,
      ]);
    } else {
      return response()->json([
        'message' => 'Internal Server Error',
        'code' => 500,
        'data' => [],
      ]);
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $articleId = $request->id;

    if ($articleId) {
      // update the value
      $articles = Article::updateOrCreate(
        ['id' => $articleId],
        ['title' => $request->title, 'content' => $request->content, 'category'=> $request->category, 'is_active' => $request->is_active ]
      );

      // user updated
      return response()->json('Updated');
    } else {
      // create new one if email is unique
      $ticketTitle = Article::where('title', $request->title)->first();
  
      if (empty($ticketTitle)) {
          $ticket = Article::create([
            'title' => $request->title,'content' => $request->content, 'category'=> $request->category, 'is_active' => $request->is_active
          ]);

          return response()->json('Created');
      } else {
          return response()->json(['message' => 'already exists'], 422);
      }
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
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $where = ['id' => $id];

    $users = Article::where($where)->first();

    return response()->json($users);
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
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $users = Article::where('id', $id)->delete();
  }
}
