<?php

use Cake\Utility\Inflector;
?>

<div class="row flex-row">
    <div class="col-xl-12">
        <!-- Form -->
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions d-flex align-items-center">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dt-buttons btn">
                            <a class="btn btn-warning btn-flat" href="<?= $this->Url->build(['action' => 'add']) ?>">
                                <i class="la la-plus"></i>
                                <?php echo __('Add New ' . $curController); ?>
                            </a>
                        </div>
                        <div class="dt-buttons btn">
                            <a class="btn btn-gradient-04 btn-flat" href="<?= $this->Url->build(['action' => 'index']) ?>">
                                <i class="la la-list"></i>
                                <?php echo __('List ' . $curController); ?>
                            </a>
                        </div>
                        <div class="dt-buttons btn">
                            <a class="btn btn-gradient-02 btn-flat" href="<?= $this->Url->build(['action' => 'edit', $entityModel->id]) ?>">
                                <i class="la la-edit"></i>
                                <?php echo __('Edit ' . $curController); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget-body">
                <div class="table-responsive">
                    <table class="table mb-0  table-striped">
                        <tbody>
                            <tr>
                                <td style="width: 25%;" ><?= __('Id') ?></td>
                                <td><?= $this->Number->format($entityModel->id) ?></td>
                            </tr>
                            <?php foreach ($inputFields as $field => $input) : ?>
                                <tr>
                                    <td style="width: 25%;" ><?= $input['label'] ?></td>
                                    <?php if ($input['type'] == 'checkbox'): ?>
                                        <td>
                                            <?php if (!empty($entityModel->$field)): ?>
                                                <span class="badge-text badge-text-small info"><?= __('Yes') ?></span>
                                            <?php else : ?>
                                                <span class="badge-text badge-text-small danger"><?= __('No') ?></span>
                                            <?php endif; ?>
                                        </td>
                                    <?php elseif ($input['type'] == 'image'): ?>
                                        <td>
                                            <?php $fieldTemp = !empty($input['format']) ? $input['format'] : '' ?>
                                            <?php if (!empty($fieldTemp)) : ?>
                                                <?php $photo = $this->Cf->imageUrl(h($entityModel->$fieldTemp)); ?>
                                                <a href="<?php echo $photo; ?>" class="banner-link" style="display: block;">
                                                    <img src="<?php echo $photo; ?>" width="100" />
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    <?php elseif ($input['type'] == 'video'): ?>
                                        <td>   
                                            <?php $fieldTemp = !empty($input['format']) ? $input['format'] : '' ?>
                                            <?php if (!empty($fieldTemp)) : ?>
                                                <?php $video = $this->Cf->imageUrl(h($entityModel->$fieldTemp)); ?>
                                                <a href="<?php echo $photo; ?>" class="banner-link" style="display: block;">
                                                    <video width="320" height="240" controls>
                                                        <source src="<?php echo $video; ?>" type="video/mp4" />
                                                    </video>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    <?php elseif ($input['type'] == 'multiple_image'): ?>
                                        <td>   
                                            <?php $fieldTemp = !empty($input['format']) ? $input['format'] : '' ?>
                                            <?php if (!empty($fieldTemp)) : ?>

                                            <?php endif; ?>
                                        </td>
                                    <?php else: ?>
                                        <?php if (!empty($input['format'])): ?>
                                            <?php $fieldTemp = !empty($input['format']) ? $input['format'] : '' ?>
                                            <td><?= $entityModel->$fieldTemp ?></td>
                                        <?php elseif (!empty($input['render'])): ?>
                                            <td>
                                                <?=
                                                $this->element('/CustomView/' . $input['render'], ['entityModel' => $entityModel,
                                                    'field' => $field,
                                                    'fieldInfo' => $input,
                                                ]);
                                                ?>
                                            </td>
                                        <?php else: ?>
                                            <td><?= h($entityModel->$field) ?></td>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                            <?php foreach ($inputLangFields as $field => $input) : ?>
                                <tr>
                                    <td style="width: 25%;" ><?= $input['label'] ?></td>
                                    <td>
                                        <div class="widget has-shadow">
                                            <div class="widget-body sliding-tabs">
                                                <ul class="nav nav-tabs" id="example-one" role="tablist">
                                                    <?php foreach ($listLanguage as $languageCode => $languageName) : ?>
                                                        <li class="nav-item">
                                                            <a class="nav-link <?= $languageCode == $defaultLanguage ? 'active show' : '' ?>" id="base-<?= $languageCode . "-$field" ?>" data-toggle="tab" href="#<?= $languageCode . "-$field" ?>" role="tab" aria-controls="<?= $languageCode . "-$field" ?>" aria-selected="<?= $languageCode == $defaultLanguage ? 'true' : 'false' ?>"><?= $languageName ?></a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                                <div class="tab-content pt-3">
                                                    <?php foreach ($listLanguage as $languageCode => $languageName) : ?>
                                                        <div class="tab-pane fade <?= $languageCode == $defaultLanguage ? 'active show' : '' ?>" id="<?= $languageCode . "-$field" ?>" role="tabpanel" aria-labelledby="base-<?= $languageCode . "-$field" ?>">
                                                            <?php if ($input['type'] == 'checkbox'): ?>
                                                                <?php if (!empty($entityModel->lang[$languageCode][$field])): ?>
                                                                    <span class="badge-text badge-text-small info"><?= __('Yes') ?></span>
                                                                <?php else : ?>
                                                                    <span class="badge-text badge-text-small danger"><?= __('No') ?></span>
                                                                <?php endif; ?>
                                                            <?php elseif ($input['type'] == 'image'): ?>
                                                                <?php $fieldTemp = !empty($input['format']) ? $input['format'] : '' ?>
                                                                <?php if (!empty($fieldTemp)) : ?>
                                                                    <?php $photo = $this->Cf->imageUrl(h($entityModel->lang[$languageCode][$fieldTemp])); ?>
                                                                    <a href="<?php echo $photo; ?>" class="banner-link" style="display: block;">
                                                                        <img src="<?php echo $photo; ?>" width="100" />
                                                                    </a>
                                                                <?php endif; ?>
                                                            <?php elseif ($input['type'] == 'video'): ?>
                                                                <?php $fieldTemp = !empty($input['format']) ? $input['format'] : '' ?>
                                                                <?php if (!empty($fieldTemp)) : ?>
                                                                    <?php $video = $this->Cf->imageUrl(h($entityModel->lang[$languageCode][$fieldTemp])); ?>
                                                                    <a href="<?php echo $photo; ?>" class="banner-link" style="display: block;">
                                                                        <video width="320" height="240" controls>
                                                                            <source src="<?php echo $video; ?>" type="video/mp4" />
                                                                        </video>
                                                                    </a>
                                                                <?php endif; ?>
                                                            <?php elseif ($input['type'] == 'multiple_image'): ?>
                                                                <?php $fieldTemp = !empty($input['format']) ? $input['format'] : '' ?>
                                                                <?php if (!empty($fieldTemp)) : ?>

                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <?php if (!empty($input['format'])): ?>
                                                                    <?php $fieldTemp = !empty($input['format']) ? $input['format'] : '' ?>
                                                                    <td><?= $entityModel->lang[$languageCode][$fieldTemp] ?></td>
                                                                <?php elseif (!empty($input['render'])): ?>
                                                                    <?=
                                                                    $this->element('/CustomView/' . $input['render'], ['entityModel' => $entityModel,
                                                                        'field' => $field,
                                                                        'fieldInfo' => $input,
                                                                    ]);
                                                                    ?>
                                                                <?php else: ?>
                                                                    <?= h($entityModel->lang[$languageCode][$field]) ?>
                                                                <?php endif; ?>
                                                            <?php endif; ?>

                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td style="width: 25%;" ><?= __('Modified') ?></td>
                                <td><?= h($entityModel->modified) ?></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;" ><?= __('Created') ?></td>
                                <td><?= h($entityModel->created) ?></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="text-center">
                    <?= $this->Html->link('<i class="fa fa-chevron-left"></i>' . __(' Back'), !empty($lastUrl) ? $lastUrl : ['action' => 'index', 'type' => $this->request->getQuery('type')], array('class' => 'btn btn-white', 'title' => __('Back to ' . $tableName . ' list'), 'escapeTitle' => false)) ?>
                    <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>' . __(' Delete'), ['action' => 'delete', $entityModel->id, 'type' => $this->request->getQuery('type')], ['title' => __('Delete ' . $tableName), 'class' => 'btn btn-danger', 'escapeTitle' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $entityModel->id)]) ?>
                </div>

            </div>
        </div>
        <!-- End Form -->
    </div>
</div>
<!-- End Row -->