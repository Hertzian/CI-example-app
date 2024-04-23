<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Article<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1><?= esc($article->title) ?></h1>

<?php if ($article->image) : ?>

  <img src="<?= url_to('Article\Image::get', $article->id) ?>" alt="">

  <?= form_open('articles/' . $article->id . '/image/delete') ?>

  <button>Delete</button>

  <?= form_close() ?>

<?php else : ?>

  <a href="<?= url_to('Article\Image::new', $article->id) ?>">Edit image</a>

<?php endif; ?>

<p><?= esc($article->content) ?></p>

<?php if (
  $article->isOwner() || auth()->user()
  // ->hasPermission('articles.edit')) : 
  ->can('articles.edit')
) :
?>
  <!-- the comparison above comes from Article Entity class -->
  <a href="<?= url_to('Articles::edit', $article->id) ?>">-Edit</a>

<?php endif; ?>

<?php if (
  $article->isOwner() || auth()->user()
  // ->hasPermission('articles.delete')) : 
  ->can('articles.delete') // assign permissions to groups
) :
?>

  <a href="<?= url_to('Articles::confirmDelete', $article->id) ?>">-Delete</a>

<?php endif; ?>

<?= $this->endSection() ?>