<div class="col-lg-12">
    <table class="table-striped" style="width: 100%;">
        <tbody>
            <tr>
                <th><?= __('') ?></th>
                <th><?= __('Show Menu') ?></th>
                <th><?= __('Index') ?></th>
                <th><?= __('view') ?></th>
                <th><?= __('Add') ?></th>
                <th><?= __('Edit') ?></th>
                <th><?= __('Delete') ?></th>
            </tr>
            <?php $value = $entityModel->$field ?>
            <?php $custom = $fieldInfo['custom'] ?>
            <?php foreach ($custom as $menu): ?>
                <?php if (!empty($menu['controller'])) : ?>
                    <tr>
                        <th><?= $menu['name'] ?></th>
                        <td>       
                            <div class="custom-control custom-checkbox styled-checkbox">
                                <input type="hidden" name="<?= $field ?>[<?= $menu['controller'] ?>][menu]" value="0" />
                                <input <?= !empty($value[$menu['controller']]['menu']) ? 'checked' : '' ?> value="1" class="custom-control-input" type="checkbox" name="<?= $field ?>[<?= $menu['controller'] ?>][menu]" id="check-<?= $field ?>[<?= $menu['index'] ?>][menu]" >
                                <label class="custom-control-descfeedback" for="check-<?= $field ?>[<?= $menu['index'] ?>][menu]">
                                </label>
                            </div>
                        </td>
                        <td>       
                            <div class="custom-control custom-checkbox styled-checkbox">
                                <input type="hidden" name="<?= $field ?>[<?= $menu['controller'] ?>][index]" value="0" />
                                <input <?= !empty($value[$menu['controller']]['index']) ? 'checked' : '' ?>  value="1" class="custom-control-input" type="checkbox" name="<?= $field ?>[<?= $menu['controller'] ?>][index]" id="check-<?= $field ?>[<?= $menu['index'] ?>][index]" >
                                <label class="custom-control-descfeedback" for="check-<?= $field ?>[<?= $menu['index'] ?>][index]">
                                </label>
                            </div>
                        </td>
                        <td>       
                            <div class="custom-control custom-checkbox styled-checkbox">
                                <input type="hidden" name="<?= $field ?>[<?= $menu['controller'] ?>][view]" value="0" />
                                <input <?= !empty($value[$menu['controller']]['view']) ? 'checked' : '' ?>  value="1" class="custom-control-input" type="checkbox" name="<?= $field ?>[<?= $menu['controller'] ?>][view]" id="check-<?= $field ?>[<?= $menu['index'] ?>][view]" >
                                <label class="custom-control-descfeedback" for="check-<?= $field ?>[<?= $menu['index'] ?>][view]">
                                </label>
                            </div>
                        </td>
                        <td>       
                            <div class="custom-control custom-checkbox styled-checkbox">
                                <input type="hidden" name="<?= $field ?>[<?= $menu['controller'] ?>][add]" value="0" />
                                <input <?= !empty($value[$menu['controller']]['add']) ? 'checked' : '' ?>  value="1" class="custom-control-input" type="checkbox" name="<?= $field ?>[<?= $menu['controller'] ?>][add]" id="check-<?= $field ?>[<?= $menu['index'] ?>][add]" >
                                <label class="custom-control-descfeedback" for="check-<?= $field ?>[<?= $menu['index'] ?>][add]">
                                </label>
                            </div>
                        </td>

                        <td>       
                            <div class="custom-control custom-checkbox styled-checkbox">
                                <input type="hidden" name="<?= $field ?>[<?= $menu['controller'] ?>][edit]" value="0" />
                                <input <?= !empty($value[$menu['controller']]['edit']) ? 'checked' : '' ?>  value="1" class="custom-control-input" type="checkbox" name="<?= $field ?>[<?= $menu['controller'] ?>][edit]" id="check-<?= $field ?>[<?= $menu['index'] ?>][edit]" >
                                <label class="custom-control-descfeedback" for="check-<?= $field ?>[<?= $menu['index'] ?>][edit]">
                                </label>
                            </div>
                        </td>
                        <td>       
                            <div class="custom-control custom-checkbox styled-checkbox">
                                <input type="hidden" name="<?= $field ?>[<?= $menu['controller'] ?>][delete]" value="0" />
                                <input <?= !empty($value[$menu['controller']]['delete']) ? 'checked' : '' ?>  value="1" class="custom-control-input" type="checkbox" name="<?= $field ?>[<?= $menu['controller'] ?>][delete]" id="check-<?= $field ?>[<?= $menu['index'] ?>][delete]" >
                                <label class="custom-control-descfeedback" for="check-<?= $field ?>[<?= $menu['index'] ?>][delete]">
                                </label>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
    </table>
</div>


