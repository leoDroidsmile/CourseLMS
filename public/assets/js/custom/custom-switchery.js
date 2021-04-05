/*
---------------------------------
    : Custom - Switchery js :
---------------------------------
*/
!function($) {
    "use strict";
    /* -- Switchery - Colored Switches -- */
    $('.js-switch-primary').each(function (index, element) {
        new Switchery(element, { color: '#506fe4' });
    });

    $('.js-switch-secondary').each(function (index, element) {
        new Switchery(element, { color: '#96a3b6' });
    });
    $('.js-switch-success').each(function (index, element) {
        new Switchery(element, { color: '#43d187' });
    });
    $('.js-switch-danger').each(function (index, element) {
        new Switchery(element, { color: '#f9616d' });
    });
    $('.js-switch-warning').each(function (index, element) {
        new Switchery(element, { color: '#f7bb4d' });
    });
}(window.jQuery);
