<label for="title">Title</label>
<input type="text" id="title" name="title" value="<?= old('title', esc($article->title)) ?>">

<label for="content">Content</label>
<textarea name="content" id="content" cols="50" rows="10"><?= old('content', esc($article->content)) ?></textarea>

<button>Save</button>