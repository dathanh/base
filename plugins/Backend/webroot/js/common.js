function customToast(type, message) {
    this.type = type;
    this.message = message;
    var self = this;
    new Noty({
        type: self.type,
        layout: 'topRight',
        text: self.message,
        progressBar: true,
        timeout: 500,
        animation: {
            open: 'animated bounceInRight', // Animate.css class names
            close: 'animated bounceOutRight' // Animate.css class names
        }
    }).show();
}

$(document).ready(function () {
    if ($('#cake-message').length > 0) {
        new customToast($('#cake-message-type').val(), $('#cake-message').val());
    }

    $('.toggle-checkbox').on('click', function () {
        var curElm = $(this);
        var controller = curElm.attr('data-controller');
        var target = curElm.attr('data-target');
        var type = curElm.attr('data-type');
        var value = curElm.attr('data-value');
        if (!_.isEmpty(controller) && !_.isEmpty(target) && !_.isEmpty(type)) {
            $.ajax({
                url: '/backend/' + controller + '/change-status',
                dataType: 'json',
                type: 'POST',
                data: {
                    id: target,
                    type: type,
                    value: value,
                },
                global: false,
                success: function (response) {
                    curElm.attr('data-value', response.data);
                    new customToast('success', response.message);
                },
                error: function (response) {
                    new customToast('error', response.responseJSON.message);
                }
            });
        }
    });

})
$(document).on('change', 'input[type="file"]', function () {
    showImageUpload(this);
});
function showImageUpload(input) {
    if (input.files && input.files[0]) {
        if ((input.files[0].size > 5000000) && ($(input).attr('data-type') != 'video')) {
            $(input).val('')
            new customToast('error', 'Please make sure your file less than 5 MB.');
        } else {
            var reader = new FileReader();
            reader.onload = function (e) {
                var selectorImage = `img[data-image="${$(input).attr('name')}"]`;
                if ($(selectorImage).attr('data-image')) {

                    if ($(input).attr('data-type') == 'video') {
                        $(input).parents('.input-group').prevAll('a').child('source').attr('src', e.target.result);
                    } else {
                        $(input).parents('.input-group').prevAll('a').children('img').attr('src', e.target.result);
                    }
                } else {
                    if ($(input).attr('data-type') == 'video') {
                        $(input).parents('.col-lg-10').children('.videoUpload').remove();
                        $(input).parents('.input-group').before(`<video class="videoUpload" height="175" controls> <source src="${e.target.result}"type="video/mp4" ></video>`);
                    } else {
                        $(input).parents('.col-lg-10').children('.imageUpload').remove();
                        $(input).parents('.input-group').before(`<img class="imageUpload" style="display: block; margin-bottom: 20px;" data-image="${$(selectorImage).attr('data-image')}" src="${e.target.result}" width="70" />`);
                    }
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
}