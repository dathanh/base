<?php $id == $this->request->getSession()->read('Auth.User.id') ? $disabled = true : $disabled = false ?>
<td class="td-actions">
    <?= $this->Html->link('<i class="la la-eye more"></i>', ['action' => 'view', $id], ['title' => __('View'), 'escape' => false]) ?>
    <?= $this->Html->link('<i class="la la-edit edit"></i>', ['action' => 'edit', $id], ['title' => __('Edit'), 'escape' => false]) ?>
    <?= $this->Form->postLink('<i class="la la-close delete"></i>', ['action' => 'delete', $id], ['title' => __('Delete'), 'escape' => false, 'block' => $disabled, 'confirm' => __('Are you sure you want to delete # {0}?', $id)]) ?>
</td>