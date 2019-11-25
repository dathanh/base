<?php echo $this->Html->script('/backend/ckeditor/ckeditor.js'); ?>
<script type="text/javascript">
<?php foreach ($elements as $element): ?>
        $('textarea#<?php echo $element; ?>').each(function () {
            CKEDITOR.replace($(this).attr('name'), {
                filebrowserBrowseUrl: '/kcfinder/browse.php?opener=ckeditor&type=files',
                filebrowserImageBrowseUrl: '/kcfinder/browse.php?opener=ckeditor&type=images',
                filebrowserUploadUrl: '/kcfinder/upload.php?opener=ckeditor&type=files',
                filebrowserImageUploadUrl: '/kcfinder/upload.php?opener=ckeditor&type=images',
            });
        });
<?php endforeach; ?>
</script>