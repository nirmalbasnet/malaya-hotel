(function ($) {
    "use strict";

    $('#select-type').on('change', function(){
        if($('#select-type option:selected').val()=='email'){
            $('.verify').show();
        }else{
            $('.verify').hide();
        }
        if($('#select-type option:selected').val()=='ticket'){
            $('.verify, .error').hide();
            $('.success').show();
        }else{
            $('.success').hide();
        }
    });
})(jQuery);
