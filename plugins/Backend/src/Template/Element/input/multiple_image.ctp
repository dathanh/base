<?php

use Cake\Utility\Inflector;

$fieldGallery = 'gallery' . Inflector::camelize($field);
?>

<div class="form-group row d-flex align-items-center mb-5">
    <label class="col-lg-2 form-control-label d-flex justify-content-lg-end <?= !empty($error) ? 'text-danger' : '' ?> ">
        <?= $label ?><?= $require ? '<span style="margin-left:3px" class="text-danger">(*)</span>' : '' ?>
    </label>
    <div class="col-lg-10">
        <div id="galleryImage" class="dropzone-css" style="border: 4px dotted #1ab394;border-radius: 30px;" >
            <div class="dz-message">
                <h1 style="text-align:center"><?= __('Drop files here or click to upload') ?></h1>
            </div>
        </div>
        <div class="dz-filename"><span data-dz-name class="badge badge-success"></span></div>
        <?php if (!empty($error)) : ?>
            <div class="invalid-feedback">
                <?= implode('<br />', $error); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $this->start('customCss'); ?>
<?= $this->fetch('customCss') ?>
<link rel="stylesheet" href="/backend/assets/css/dropzone/basic.css">
<link rel="stylesheet" href="/backend/assets/css/dropzone/dropzone.css">
<?php $this->end(); ?>
<?php $this->start('customJs'); ?>
<?= $this->fetch('customJs') ?>
<script src="/backend/assets/js/components/dropzone/dropzone.js"></script>
<script>
    var mockFile = JSON.parse('<?= !empty($entityModel->$fieldGallery) ? $entityModel->$fieldGallery : '[]' ?>');
    $(document).ready(function () {
        $("div#galleryImage").dropzone({
            addRemoveLinks: true,
            csrfToken: "<?= $this->request->getParam('_csrfToken') ?>",
            url: "/backend/<?= $this->request->getParam(['controller']) ?>/uploadMultiFile",
            init: function () {
                var dz = this;
                if (typeof mockFile !== 'undefined') {
//                            console.log(mockFile);
                    mockFile.forEach(function (filedata) {
                        var tmp = [];
                        tmp.name = filedata;
                        tmp.image = '/uploads/Careers/Gallery/' + filedata;
                        dz.options.addedfile.call(dz, tmp);
                        dz.options.thumbnail.call(dz, tmp, tmp.image);
                    });
                }

                dz.on('removedfile', function (file) {
                    $.ajax({
                        url: '/backend/<?= $this->request->getParam(['controller']) ?>/removeMultiFile',
                        dataType: 'json',
                        type: 'POST',
                        headers: {'X-CSRF-Token': '<?= $this->request->getParam('_csrfToken') ?>'},
                        data: {
                            fileRemove: (file.hasOwnProperty('upload')) ? file.upload.filename : '',
                            fileNameDefault: file.name
                        },
                        global: false,
                        success: function (response) {
                            $(`input[data-filename="${file.name}"]`).remove();
                            if (file.hasOwnProperty('upload')) {
                                $(`input[data-filename="${file.upload.filename}"]`).remove();
                            }
                        },

                    });
                });
                dz.on('success', function (file) {
                    var args = Array.prototype.slice.call(arguments);
                    // Look at the output in you browser console, if there is something interesting
                    var respone = JSON.parse(args[1]);
                    file.upload.filename = respone.data;
                    $(file.previewTemplate).after(`<input data-filename="${respone.data}" type="hidden" name="<?= $field . '[]' ?>" value="${respone.data}" />`);
                });
            }

        });
        if (typeof mockFile !== 'undefined') {
            for (i = 0; i < $('.dz-details').length; i++) {
                $($('.dz-preview')[i]).after(`<input data-filename="${mockFile[i]}" type="hidden" name="<?= $field . '[]' ?>" value="${mockFile[i]}" />`);
            }
        }
    });
</script>
<?php $this->end(); ?>
