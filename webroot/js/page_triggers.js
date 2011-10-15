$(document).ready(function() {
  $(document).trigger('pageChanged');
  $(document).trigger('pageUpdated');
});

$(document).bind('end.pjax', function() {
  $(document).trigger('pageChanged');
  $(document).trigger('pageUpdated');
});

$(document).bind('ajaxComplete', function() {
  $(document).trigger('pageUpdated');
});
