<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Entities\Article;
use CodeIgniter\Exceptions\PageNotFoundException;

class Articles extends BaseController
{
  // to clean up the same call over various methods
  private ArticleModel $model;

  public function __construct()
  {
    $this->model = new ArticleModel;
  }

  public function index()
  {
    // test db connection
    // $db = db_connect();
    // $db->listTables();

    // no need of this because the constructor
    // $model = new ArticleModel;

    $data = $this
      ->model
      ->select('article.*, users.first_name')
      ->join('users', 'users.id = article.users_id')
      ->orderBy('created_at')
      ->paginate(3);

    // dd($data); // dump & die
    return view('Articles/index', [
      'articles' => $data,
      'pager' => $this->model->pager
    ]);
  }

  public function show($id)
  {
    $article = $this->getArticleOr404($id);

    return view('Articles/show', [
      'article' => $article
    ]);
  }

  public function new()
  {
    // this variable is for the form view, to keep working
    // $article = [
    //   'title' => '',
    //   'content' => ''
    // ];

    // return view('Articles/new', ['article' => $article]);
    return view('Articles/new', ['article' => new Article]);
  }

  public function create()
  {
    // dd($this->request->getPost('title')); // can be without any args to retrieve the entire POST object

    // this is before having an entity
    // $id = $model->insert($this->request->getPost());

    // this is with entity
    $article = new Article($this->request->getPost());

    // insert() return the inserted object
    $id = $this->model->insert($article);

    // dd($model->insertID); // check the inserted id from the request
    if ($id === false) {
      // dd($model->errors());
      return redirect()
        ->back()
        ->with('errors', $this->model->errors())
        ->withInput();
    }

    return redirect()
      ->to("articles/$id") // double quotes to identify the variable
      ->with('message', 'Article saved');
  }

  public function edit($id)
  {
    $article = $this->getArticleOr404($id);

    if ($article === null) {
      throw new PageNotFoundException("Article with id $id not found");
    }

    return view('Articles/edit', [
      'article' => $article
    ]);
  }

  public function update($id)
  {
    $article = $this->getArticleOr404($id);
    $article->fill($this->request->getPost());

    if ($article === null) {
      throw new PageNotFoundException("Article with id $id not found");
    }

    $article->__unset('_method'); // for the hidden input in the form preventing exception

    // check if any attribute has changed
    // $article->hasChanged('title') can have a param with the field to check
    if (!$article->hasChanged()) {
      return redirect()
        ->back()
        ->with('message', 'Nothing to update');
    }

    // without Entity
    // if ($model->update($id, $this->request->getPost())) {
    // with Entity
    // save() just returns a boolean value
    if ($this->model->save($article)) {
      return redirect()
        ->to("articles/$id")
        ->with('message', 'Article updated');
    }

    return redirect()
      ->back()
      ->with('errors', $this->model->errors())
      ->withInput();
  }

  public function confirmDelete($id)
  {
    $article = $this->getArticleOr404($id);

    return view('Articles/delete', [
      'article' => $article
    ]);
  }

  public function delete($id)
  {
    $this->getArticleOr404($id);

    $this->model->delete($id);

    return redirect()
      ->to('articles')
      ->with('message', 'Article deleted');
  }

  // with view included
  // public function delete($id)
  // {
  //   $article = $this->getArticleOr404($id);

  //   // this validate if the request is post or get to delete the entry
  //   if ($this->request->is('delete')) {
  //     $this->model->delete($id);

  //     return redirect()
  //       ->to('articles')
  //       ->with('message', 'Article deleted');
  //   }

  //   return view('Articles/delete', [
  //     'article' => $article
  //   ]);
  // }

  private function getArticleOr404($id): Article
  {
    $article = $this->model->find($id);

    if ($article === null) {
      throw new PageNotFoundException("Article with id $id not found");
    }

    return $article;
  }
}
