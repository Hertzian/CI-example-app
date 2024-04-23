<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Edit article<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Set Password</h1>

<?php if (session()->has('errors')) : ?>

  <ul>
    <?php foreach (session('errors') as $error) : ?>
      <li><?= $error ?></li>
    <?php endforeach; ?>
  </ul>

<?php endif; ?>

<?=
form_open() // the default is the current url, (also in the routes file) but in this case in with POST method
?>

<label for="password">Password</label>
<input type="password" name="password" id="password">

<label for="password_confirmation">Repeat password</label>
<input type="password" name="password_confirmation" id="password_confirmation">

<button>Save</button>

<?= form_close() ?>

<?= $this->endSection() ?>