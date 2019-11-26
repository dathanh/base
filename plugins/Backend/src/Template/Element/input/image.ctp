<?php

use Cake\Utility\Inflector;

$fieldLink = 'link' . Inflector::camelize($nameField);
?>

<div class="form-group row d-flex align-items-center mb-5">
    <label class="col-lg-2 form-control-label d-flex justify-content-lg-end <?= !empty($error) ? 'text-danger' : '' ?> ">
        <?= $label ?><?= $require ? '<span style="margin-left:3px" class="text-danger">(*)</span>' : '' ?>
    </label>
    <div class="col-lg-10">
        <?php if (empty($languageCode)): ?>
            <?php if (!empty($entityModel->$fieldLink)): ?>
                <?php $photo = $this->Cf->imageUrl($entityModel->$fieldLink); ?>
                <a  class="imageUpload" href="<?php echo $photo; ?>" class="thumbnail-link" style="display: block; margin-bottom: 10px;">
                    <img src="<?php echo $photo; ?>" width="100" />
                </a>
                <input type="hidden" name="<?= $field ?>" value="<?php echo $entityModel->$field; ?>" />
                <div class="clearfix"></div>
            <?php endif; ?>
        <?php else: ?>
            <?php if (!empty($entityModel->lang[$languageCode][$fieldLink])): ?>
                <?php $photo = $this->Cf->imageUrl($entityModel->lang[$languageCode][$fieldLink]); ?>
                <a  class="imageUpload" href="<?php echo $photo; ?>" class="thumbnail-link" style="display: block; margin-bottom: 10px;">
                    <img src="<?php echo $photo; ?>" width="100" />
                </a>
                <input type="hidden" name="<?= $field ?>" value="<?php echo $entityModel->lang[$languageCode][$nameField]; ?>" />
                <div class="clearfix"></div>
            <?php endif; ?>
        <?php endif; ?>
        <div class="input-group">
            <?php $field = !empty($languageCode) ? str_replace(']', '_upload]', $field) : $field . '_upload' ?>
            <input value="<?= $value ?>" name="<?= $field ?>" type="file" class="form-control" placeholder="<?= !empty($placehoder) ? $placehoder : $label ?>" <?= !empty($error) ? 'required' : '' ?>>
            <?php if (!empty($error)) : ?>
                <div class="invalid-feedback">
                    <?= implode('<br />', $error); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>