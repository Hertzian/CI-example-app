<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>New article<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>New article</h1>

<?php if (session()->has('errors')) : ?>

  <ul>
    <?php foreach (session('errors') as $error) : ?>
      <li><?= $error ?></li>
    <?php endforeach; ?>
  </ul>

<?php endif; ?>

<?= form_open('articles') ?>

<?= $this->include('Articles/form') ?>

<?= form_close() ?>

<?= $this->endSection() ?>