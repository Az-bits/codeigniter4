
<div class="form-group">
    <label for="title"><?= lang('Form.title')?></label>
    <input class="form-control" type="description" id='title' name="title" value="<?= old('title',$category->title)?>" /><br />
</div>
<button class="mt-2 btn btn-success" type="submit"><i class="fa fa-save"></i> <?= $textButton?></button>

