<?php

use Cake\Utility\Inflector; ?>

<?php $controller = Inflector::humanize(Inflector::underscore($this->request->getParam('controller'))) ?>
<!-- Begin Page Header-->
<div class="row">
    <div class="page-header">
        <div class="d-flex align-items-center">
            <h2 class="page-header-title"><?= $controller . ' - ' . $this->request->getParam('action') ?></h2>
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= $this->Url->build(['controller' => 'AdminDashboard', 'action' => 'index']) ?>"><i class="ti ti-home"></i></a></li>
                    <?php if ($this->request->getParam('controller') != 'AdminDashboard') : ?>
                        <li class="breadcrumb-item active"><?= $controller ?></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Page Header -->