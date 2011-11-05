<?php
class PjaxComponent extends Component {

  private $C = null;

  private $enabled = true;

  public function initialize(&$controller) {
    $this->C = $controller;
  }

  public function startup(&$controller) {
    if ($this->enabled == true && $this->isPjaxRequest()) {
      $this->C->layout = 'ajax';
    }
  }

  public function enabled() {
    $this->enabled = true;
  }

  public function disabled() {
    $this->enabled = false;
  }

  public function isPjaxRequest() {
    if (isset($__SERVER['HTTP_X_PJAX']) && $__SERVER['HTTP_X_PJAX'] == true ||
        isset($this->C->request->query['_pjax']) && $this->C->request->query['_pjax'] == true) {
      return true;
    }
    return false;
  }

  public function redirect($url) {
    $new_url = Router::url($url);
    $path = preg_replace('/'.str_replace('/', '\/', $this->C->base).'/', '', $new_url);
    $html = $this->C->requestAction($path, array('return'));
    $this->C->set(compact('new_url', 'html'));
    $this->C->render(APP.'plugins'.DS.'pjax'.DS.'views'.DS.'elements'.DS.'redirect_pjax_to.ctp');
  }
}
