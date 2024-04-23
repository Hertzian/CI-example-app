<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Delete article <?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Delete article</h1>
<p>Are you sure?</p>

<?= form_open('articles/' . $article->id) ?>

<input type="hidden" name="_method" value="delete" />

<button>Yes</button>

<?= form_close() ?>

<?= $this->endSection() ?>