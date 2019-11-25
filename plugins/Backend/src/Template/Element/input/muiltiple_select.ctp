<?php $this->start('customCss'); ?>
<?= $this->fetch('customCss') ?>
<link rel="stylesheet" href="/backend/assets/css/bootstrap-select/bootstrap-select.min.css">
<?php $this->end(); ?>
<?php $this->start('customJs'); ?>
<?= $this->fetch('customJs') ?>
<script src="/backend/assets/vendors/js/bootstrap-select/bootstrap-select.min.js"></script>
<?php $this->end(); ?>
<div class="form-group row d-flex align-items-center mb-5">
    <label class="col-lg-2 form-control-label d-flex justify-content-lg-end <?= !empty($error) ? 'text-danger' : '' ?> ">
        <?= $label ?><?= $require ? '<span style="margin-left:3px" class="text-danger">(*)</span>' : '' ?>
    </label>
    <div class="col-lg-10">
        <div class="dropdown bootstrap-select show-tick show-menu-arrow dropup form-control">
            <select name="<?= $field ?>[]" class="selectpicker show-menu-arrow form-control" multiple tabindex="-98">
                <?php foreach ($custom as $index => $option): ?>
                    <option <?= (in_array($index, $value)) ? 'selected' : '' ?> value="<?= $index ?>" ><?= $option ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>