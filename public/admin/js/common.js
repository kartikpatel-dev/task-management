(function ($) {
    'use strict'

    bsCustomFileInput.init();

    $(document).on('hidden.bs.modal', function () {
        $('.modal-backdrop').remove();
        $('body').css('overflow', '');
    });
})(jQuery);

// number validation
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }

    return true;
}

function slug(str) {
    return str.replace(/[^a-z0-9\s]/gi, " ").replace(/^\s+|\s+$|\s+(?=\s)/g, "").replace(/[_\s]/g, "-").toLowerCase();
}