<div class="adminResources index large-9 medium-8 columns content">
    <h3><?= __('Welcome Administrator') ?></h3>
</div>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <?php if (!empty($menu)) : ?>
            <?php foreach ($menu as $key => $item) : ?>
                <?php if (!empty($item['controller'])) : ?>
                    <?php if (in_array($item['controller'], $listMenuCanShow)) : ?>
                        <li><?= $this->Html->link($item['name'], ['controller' => $item['controller']]) ?></li>
                    <?php endif; ?>
                <?php else: ?>
                    <li class="heading">
                        <?= $item['name'] ?>
                    </li>
                <?php endif; ?>

            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</nav>
