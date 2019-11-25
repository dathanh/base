<div class="form-group row d-flex align-items-center mb-5">
    <label class="col-lg-2 form-control-label d-flex justify-content-lg-end <?= !empty($error) ? 'text-danger' : '' ?> ">
        <?= $label ?><?= $require ? '<span style="margin-left:3px" class="text-danger">(*)</span>' : '' ?>
    </label>
    <div class="col-lg-10">
        <div class="custom-control custom-checkbox styled-checkbox">
            <input <?= !empty($value) ? 'checked' : '' ?> class="custom-control-input" type="checkbox" name="<?= $field ?>" id="check-<?= $field ?>" <?= !empty($error) ? 'required' : '' ?>>
            <label class="custom-control-descfeedback" for="check-<?= $field ?>">
            </label>
            <?php if (!empty($error)) : ?>
                <div class="invalid-feedback">
                    <?php echo implode('<br />', $error); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>