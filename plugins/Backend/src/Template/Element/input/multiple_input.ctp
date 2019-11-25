<div class="form-group row d-flex align-items-center mb-5">
    <label class="col-lg-2 form-control-label d-flex justify-content-lg-end <?= !empty($error) ? 'text-danger' : '' ?> ">
        <?= $label ?><?= $require ? '<span style="margin-left:3px" class="text-danger">(*)</span>' : '' ?>
    </label>
    <div class="col-lg-10">
        <div class="input-group mb-5">
            <input value="<?= $value ?>" style="height: 41.5px;" name="<?= $field ?>[]" type="color" class="form-control multiple-input" placeholder="<?= !empty($placehoder) ? $placehoder : $label ?>" <?= !empty($error) ? 'required' : '' ?>>
            <a href="javascript:void(0)" class="multiple-add" >        <!-- class multiple-add, multiple-input js controll-->    
                <span class="input-group-addon addon-primary">+</span> 
            </a>
            <?php if (!empty($error)) : ?>
                <div class="invalid-feedback">
                    <?= implode('<br />', $error); ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if (!empty($entityModel->$field[2])) : ?>
            <?php foreach ($entityModel->$field as $key => $value) : ?>
                <?php if (!empty($key == 1)) : ?>
                    <?php continue; ?>
                <?php else : ?>
                    <div class="input-group mb-5">
                        <input value="<?= $value ?>" style="height: 41.5px;" name="<?= $field ?>[]" type="text" class="form-control" placeholder="<?= !empty($placehoder) ? $placehoder : $label ?>" >
                        <a href="javascript:void(0)" class="multiple-remove">  <!-- class multiple-remove js controll-->          
                            <span class="input-group-addon addon-orange ">-</span> 
                        </a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</div>
<?php $this->start('customJs'); ?>
<?= $this->fetch('customJs') ?>
<script>
    $(document).ready(function () {
        $('.multiple-add').on('click', function () {
            var curElm = $(this);
            var parentElm = curElm.parent();
            if (parentElm.find('.multiple-input').length > 0) {
                parentElm.parent().append(`<div class="input-group mb-5">${document.getElementsByClassName("multiple-input")[0].outerHTML}<a href="javascript:void(0)" class="multiple-remove"><span class="input-group-addon addon-orange ">-</span>  </a> </div>`)
            }
        });
        $(document).on('click', '.multiple-remove', function () {
            var curElm = $(this);
            $(curElm.parent()).remove();
        });
    });
</script>
<?php $this->end(); ?>
