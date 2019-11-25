<?php

use Cake\Utility\Inflector;

$fieldLink = 'link' . Inflector::camelize($field);
?>

<div class="form-group row d-flex align-items-center mb-5">
    <label class="col-lg-2 form-control-label d-flex justify-content-lg-end <?= !empty($error) ? 'text-danger' : '' ?> ">
        <?= $label ?><?= $require ? '<span style="margin-left:3px" class="text-danger">(*)</span>' : '' ?>
    </label>
    <div class="col-lg-10">
        <?php if (!empty($entityModel->$fieldLink)): ?>
            <?php $video = $this->Cf->imageUrl($entityModel->$fieldLink); ?>
            <a  class="videoUpload" href="<?php echo $video; ?>" class="video-link" style="display: block; margin-bottom: 10px;">
                <video width="320" height="240" controls>
                    <source src="<?php echo $video; ?>" type="video/mp4" />
                </video>
            </a>
            <input type="hidden" accept="video/*" name="<?= $field ?>" value="<?= $value ?>" />
            <div class="clearfix"></div>
        <?php endif; ?>
        <div class="input-group">
            <input value="<?= $value ?>" data-type="video" name="<?= $field . '_upload' ?>" type="file" class="form-control" placeholder="<?= !empty($placehoder) ? $placehoder : $label ?>" <?= !empty($error) ? 'required' : '' ?>>
            <?php if (!empty($error)) : ?>
                <div class="invalid-feedback">
                    <?= implode('<br />', $error); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>