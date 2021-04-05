(function($){

"use strict"

jQuery(document).ready(function(){

  // Demo Login info

  $('#instructor').on('click',function () {
      $('#email').val('instructor@mail.com');
      $('#password').val('12345678');
  });

  $('#admin').on('click',function () {
      $('#email').val('admin@mail.com');
      $('#password').val('12345678');
  });

});

})(jQuery);
