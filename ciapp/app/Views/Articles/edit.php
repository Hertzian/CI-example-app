<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Edit article<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Edit article</h1>

<?php if (session()->has('errors')) : ?>

  <ul>
    <?php foreach (session('errors') as $error) : ?>
      <li><?= $error ?></li>
    <?php endforeach; ?>
  </ul>

<?php endif; ?>

<?= form_open('articles/' . $article->id) ?>

<input type="hidden" name="_method" value="patch">

<?= $this->include('Articles/form') ?>

<?= form_close() ?>

<?= $this->endSection() ?>