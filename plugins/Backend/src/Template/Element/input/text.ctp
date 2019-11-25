<div class="form-group row d-flex align-items-center mb-5">
    <label class="col-lg-2 form-control-label d-flex justify-content-lg-end <?= !empty($error) ? 'text-danger' : '' ?> ">
        <?= $label ?><?= $require ? '<span style="margin-left:3px" class="text-danger">(*)</span>' : '' ?>
    </label>
    <div class="col-lg-10">
        <div class="input-group">
            <input value="<?= $value ?>" name="<?= $field ?>" type="text" class="form-control" placeholder="<?= !empty($placehoder) ? $placehoder : $label ?>" <?= !empty($error) ? 'required' : '' ?>>
            <?php if (!empty($error)) : ?>
                <div class="invalid-feedback">
                    <?= implode('<br />', $error); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>