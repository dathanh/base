<?php $this->start('customCss'); ?>
<link rel="stylesheet" href="/backend/assets/css/datatables/datatables.min.css">
<?php $this->end(); ?>

<div class="row">
    <div class="col-xl-12">
        <!-- Sorting -->
        <div class="widget has-shadow">
            <div class="widget-body">
                <div class="table-responsive">
                    <div id="sorting-table_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="dt-buttons">
                                    <a class="btn btn-warning btn-flat" href="<?= $this->Url->build(['action' => 'add']) ?>">
                                        <i class="la la-plus"></i>
                                        <?php echo __('Add New ' . $curController); ?>
                                    </a>
                                </div>
                                <div id="sorting-table_filter" class="dataTables_filter">
                                    <?php echo $this->Form->create('search', ['type' => 'get', 'name' => 'filterForm']); ?>
                                    <label>
                                        <strong class="text-gradient-03" ><?= __('Search ') ?></strong>
                                        <input value="<?php echo isset($_GET['title']) ? $_GET['title'] : ''; ?>" name="title" type="search" class="form-control form-control-sm" placeholder="<?= __('Search') ?>" aria-controls="sorting-table">
                                    </label>
                                    <?php echo $this->Form->end() ?>
                                </div>
                            </div>
                        </div>
                        <?php if (!empty($cutomHeader)) : ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <?= $this->element($cutomHeader) ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="sorting-table" class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th><?= $this->Paginator->sort('id') ?></th>
                                            <?php foreach ($fieldsIndex as $field => $fieldOption) : ?>
                                                <th><?= $this->Paginator->sort("$field", $fieldOption['label']) ?></th>
                                            <?php endforeach; ?>
                                            <th><?= __('Actions') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listData as $data): ?>
                                            <tr>
                                                <td><span class="text-primary"><?= $this->Number->format($data->id) ?></span></td>
                                                <?php foreach ($fieldsIndex as $field => $fieldOption) : ?>
                                                    <?php if (!empty($fieldOption['render'])) : ?>
                                                        <td><?= $this->Content->customFiledBackend($fieldOption['render'], $data, $field) ?></td>
                                                    <?php elseif (!empty($fieldOption['format'])) : ?>
                                                        <?php $tempField = $fieldOption['format']; ?>
                                                        <td><?php eval('echo $data->' . $tempField . ';') ?></td>
                                                    <?php else: ?>
                                                        <td><?= $data->$field ?></td>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>

                                                <?php if (!empty($customAction)) : ?>
                                                    <?= $this->element($customAction, ['id' => $data->id]) ?>
                                                <?php else: ?>
                                                    <td class="td-actions">
                                                        <?= $this->Html->link('<i class="la la-eye more"></i>', ['action' => 'view', $data->id], ['title' => __('View'), 'escape' => false]) ?>
                                                        <?= $this->Html->link('<i class="la la-edit edit"></i>', ['action' => 'edit', $data->id], ['title' => __('Edit'), 'escape' => false]) ?>
                                                        <?= $this->Form->postLink('<i class="la la-close delete"></i>', ['action' => 'delete', $data->id], ['title' => __('Delete'), 'escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $data->id)]) ?>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info">
                                    <?= $this->Paginator->counter() ?>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="sorting-table_paginate">
                                    <ul class="pagination">
                                        <?= $this->Paginator->prev('< ' . __('previous')) ?>
                                        <?= $this->Paginator->numbers() ?>
                                        <?= $this->Paginator->next(__('next') . ' >') ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Sorting -->
    </div>
</div>

<!-- End Row -->