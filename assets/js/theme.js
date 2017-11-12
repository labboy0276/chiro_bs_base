(function ($) {

  Drupal.behaviors.adjustTable = {
    attach: function() {
      // Adjust oddness that is getting added to the table.
      if($('table.field-lake').length) {
        $('table.field-lake th').removeClass('tabledrag-hide').removeAttr('style');
      }
    }
  }

})(jQuery);
