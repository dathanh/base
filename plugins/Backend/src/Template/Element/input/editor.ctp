<div class="form-group row d-flex align-items-center mb-5">
    <label class="col-lg-2 form-control-label d-flex justify-content-lg-end <?= !empty($error) ? 'text-danger' : '' ?> ">
        <?= $label ?><?= $require ? '<span style="margin-left:3px" class="text-danger">(*)</span>' : '' ?>
    </label>
    <div class="col-lg-10">
        <textarea id="editor<?= $field ?>" class="form-control editorChange"  name="<?= $field ?>"  rows="4"  placeholder="<?= !empty($placehoder) ? $placehoder : $label ?>" <?= !empty($error) ? 'required' : '' ?>><?= $value ?></textarea>
        <?php if (!empty($error)) : ?>
            <div class="input-group">
                <div class="invalid-feedback">
                    <?= implode('<br />', $error); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

