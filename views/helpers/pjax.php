<?php
class PjaxHelper extends AppHelper {

  public $helpers = array('Html');

  public function start($options = array()) {
    $options = array_merge(array(
      'jquery' => false,
    ), $options);

    $files = array(
      '/pjax/js/jquery.pjax',
      '/pjax/js/enable_pjax',
      '/pjax/js/page_triggers',
    );

    if (isset($options['jquery']) && $options['jquery'] === true) {
      array_unshift($files, '/pjax/js/jquery');
    }

    $tag = $this->Html->script($files);
    return $tag;
  }
}
