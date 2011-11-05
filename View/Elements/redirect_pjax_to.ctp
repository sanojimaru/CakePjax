<script type="text/javascript">
(function(){
  if (!window.history || !window.history.pushState) {
    window.location.href = '<?php echo $newUrl; ?>';
  } else {
    $('[data-pjax-container]').html(<?php echo json_encode($html); ?>);
    $(document).trigger('end.pjax');

    var title = $.trim($('[data-pjax-container]').find('title').remove().text());
    if (title) document.title = title;
    window.history.pushState({}, document.title, '<?php echo $newUrl; ?>');
  }
})();
</script>
