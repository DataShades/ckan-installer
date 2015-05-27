$(document).ready(function(){

    $(':input').on('focus', function(){
        var $parent = $(this).parents('.form-block');

        $parent.find('.tools').css('display', 'block');
    });

    $(':input').on('blur', function(){
        var $parent = $(this).parents('.form-block');
        $parent.find('.tools').css('display', 'none');
    });

    if ($('select').size() > 0) {
        $('select').customSelect();
    }

    $('[name=ckan_sysadmin_skip]').change(function(){
        if ($(this).is(':checked')) {
            $('[type=text], [type=password]').attr('disabled', 'disabled');
        }
        else {
            $('[type=text], [type=password]').removeAttr('disabled');
        }
    })
});
