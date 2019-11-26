<?php $fieldEditor = false; ?>

<div class="row flex-row">
    <div class="col-xl-12">
        <!-- Form -->
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions align-items-center">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dt-buttons">
                            <a class="btn btn-gradient-04 btn-flat" href="<?= $this->Url->build(['action' => 'index']) ?>">
                                <i class="la la-list"></i>
                                <?php echo __('List ' . $curController); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="widget-body">
                <div class="table-responsive">
                    <div id="sorting-table_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <?= $this->Form->create($entityModel, ['class' => 'needs-validation was-validated', 'novalidate' => 'novalidate', 'enctype' => 'multipart/form-data']); ?>
                                <?php foreach ($inputFields as $field => $input) : ?>
                                    <?php if (!empty($input['type'])): ?>
                                        <?php if ($input['type'] == 'editor') : ?>
                                            <?php $fieldEditor = true; ?>
                                        <?php endif; ?>
                                        <?=
                                        $this->element('/input/' . $input['type'], [
                                            'nameField' => $field,
                                            'field' => $field,
                                            'label' => $input['label'],
                                            'error' => !empty($errors[$field]) ? $errors[$field] : '',
                                            'value' => !empty($entityModel->$field) ? $entityModel->$field : '',
                                            'entityModel' => !empty($entityModel) ? $entityModel : '',
                                            'custom' => !empty($input['custom']) ? $input['custom'] : '',
                                            'require' => !empty($input['require']) ? $input['require'] : false,
                                        ])
                                        ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php if (!empty($inputLangFields)): ?>
                                    <div class="widget has-shadow">
                                        <div class="widget-body sliding-tabs">
                                            <ul class="nav nav-tabs" id="example-one" role="tablist">
                                                <?php foreach ($listLanguage as $languageCode => $languageName) : ?>
                                                    <li class="nav-item">
                                                        <a class="nav-link <?= $languageCode == $defaultLanguage ? 'active show' : '' ?>" id="base-<?= $languageCode ?>" data-toggle="tab" href="#<?= $languageCode ?>" role="tab" aria-controls="<?= $languageCode ?>" aria-selected="<?= $languageCode == $defaultLanguage ? 'true' : 'false' ?>"><?= $languageName ?></a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                            <div class="tab-content pt-3">
                                                <?php foreach ($listLanguage as $languageCode => $languageName) : ?>
                                                    <div class="tab-pane fade <?= $languageCode == $defaultLanguage ? 'active show' : '' ?>" id="<?= $languageCode ?>" role="tabpanel" aria-labelledby="base-<?= $languageCode ?>">
                                                        <?php foreach ($inputLangFields as $field => $input) : ?>
                                                            <?php if (!empty($input['type'])): ?>
                                                                <?php if ($input['type'] == 'editor') : ?>
                                                                    <?php $fieldEditor = true; ?>
                                                                <?php endif; ?>
                                                                <?=
                                                                $this->element('/input/' . $input['type'], [
                                                                    'nameField' => $field,
                                                                    'field' => $languageCode . "[$field]",
                                                                    'label' => $input['label'] . ' - ' . $languageCode,
                                                                    'error' => !empty($errors[$languageCode][$field]) ? $errors[$languageCode][$field] : '',
                                                                    'value' => !empty($entityModel->lang[$languageCode]) ? $entityModel->lang[$languageCode][$field] : '',
                                                                    'entityModel' => !empty($entityModel) ? $entityModel : '',
                                                                    'languageCode' => !empty($languageCode) ? $languageCode : '',
                                                                    'custom' => !empty($input['custom']) ? $input['custom'] : '',
                                                                    'require' => !empty($input['require']) ? $input['require'] : false,
                                                                ])
                                                                ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="text-right">
                                    <button class="btn btn-gradient-01" type="submit">Submit Form</button>
                                    <button class="btn btn-shadow" type="reset">Reset</button>
                                </div>
                                <?= $this->Form->end() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Form -->
    </div>
</div>
<!-- End Row -->
<?php if (!empty($fieldEditor)): ?>
    <?php $this->start('customJs'); ?>
    <?= $this->fetch('customJs') ?>
    <?= $this->Html->script('/backend/ckeditor/ckeditor.js'); ?>
    <script type="text/javascript">
        $('textarea.editorChange').each(function () {
            CKEDITOR.replace($(this).attr('name'), {
                filebrowserBrowseUrl: '/kcfinder/browse.php?opener=ckeditor&type=files',
                filebrowserImageBrowseUrl: '/kcfinder/browse.php?opener=ckeditor&type=images',
                filebrowserUploadUrl: '/kcfinder/upload.php?opener=ckeditor&type=files',
                filebrowserImageUploadUrl: '/kcfinder/upload.php?opener=ckeditor&type=images',
            });
        });
    </script>
    <?php $this->end(); ?>
<?php endif; ?>

