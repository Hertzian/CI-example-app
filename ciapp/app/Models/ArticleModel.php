<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
  protected $table = 'article';

  protected $allowedFields = ['title', 'content'];

  protected $returnType = \App\Entities\Article::class;

  protected $validationRules = [
    'title' => 'required|max_length[128]',
    'content' => 'required'
  ];

  protected $validationMessages = [ // to change the default validation messages
    'title' => [
      'required' => 'Please enter a title',
      'max_length' => '{param} maximum characters for the {field}'
    ]
  ];

  protected $beforeInsert = ['setUsersId'];

  protected $useTimestamps = true; // to add values to created_at and updated_at fields in db

  protected function setUsersId(array $data)
  {
    $data['data']['users_id'] = auth()->user()->id;
    // dd($data);
    return $data;
  }
}
