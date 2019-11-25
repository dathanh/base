<div class="mt-2">
    <label>
        <input data-controller="<?= $this->request->getParam('controller') ?>"
               data-type="<?= $name ?>"   data-target="<?= $value->id ?>"  data-value="<?= $value->$name ?>"
               class="toggle-checkbox" type="checkbox" <?= !empty($value->$name) ? 'checked="checked"' : '' ?> >
        <span>
            <span></span>
        </span>
    </label>
</div>
