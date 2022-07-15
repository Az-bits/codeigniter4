<div class="row">
    <div class="col">
        <div class="row">
            <div class="col-6">
                <label for="title"><?= lang('Form.title')?></label>
                <input class="form-control" type="description" id='title' name="title" value="<?= old('title',$movie->title)?>" /><br />
                <label  for="category_id"><?= lang('Form.category')?></label>
                <select class="form-control" name="category_id" id="category_id">
                    <?php foreach($categories as $c) :?>
                        <option <?= $movie->category_id !== $c->id ?: "selected"?> value="<?= $c->id?>"><?= $c->title?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <?php if(!$created): ?>
                        <label for="image"><?= lang('Form.image')?></label>
                        <input class="form-control" type="file" name="image" />
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-4">
        <label for="description"><?= lang('Form.description')?></label>
        <textarea class="form-control text-justify" name="description" id='description'><?= old('description',$movie->description)?></textarea><br />
        <button class="mt-2 btn btn-success float-right" type="submit"><i class="fa fa-save"></i> <?= $textButton?></button>
    </div>
</div>


