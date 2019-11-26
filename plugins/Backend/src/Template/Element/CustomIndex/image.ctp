<?php

use Cake\Utility\Inflector;

$fieldLink = 'link' . Inflector::camelize($name);
?>
<?php if (!empty($value->$fieldLink)): ?>
    <?php $photo = $this->Cf->imageUrl($value->$fieldLink); ?>
    <a  class="imageUpload" href="<?= $this->Url->build(['action' => 'view', $value->id]) ?>" class="thumbnail-link" style="display: block; margin-bottom: 10px;">
        <img src="<?php echo $photo; ?>" width="100" />
    </a>
    <div class="clearfix"></div>
<?php endif; ?>