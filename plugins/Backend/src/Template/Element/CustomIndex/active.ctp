<?php if (!empty($value->$name)): ?>
    <span class="badge-text badge-text-small info"><?= __('Yes') ?></span>
<?php else : ?>
    <span class="badge-text badge-text-small danger"><?= __('No') ?></span>
<?php endif; ?>