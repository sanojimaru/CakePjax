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
    if (isset($_SERVER['HTTP_X_PJAX']) && $_SERVER['HTTP_X_PJAX'] == true ||
        isset($this->C->request->query['_pjax']) && $this->C->request->query['_pjax'] == true) {
      return true;
    }
    return false;
  }

/**
 * !! WARNING !!
 * This fucntion is deprecated.
 */
  public function redirect($url) {
    if ($this->isPjaxRequest() && $this->C->request->is('post')) {
      $newUrl = Router::url($url);
      $path = preg_replace('/'.str_replace('/', '\/', $this->C->base).'/', '', $newUrl);
      $html = $this->C->requestAction($path, array('return'));
      $this->C->set(compact('newUrl', 'html'));
      $this->C->render(APP.'Plugin'.DS.'Pjax'.DS.'View'.DS.'Elements'.DS.'redirect_pjax_to.ctp');
    } else {
      $this->C->redirect($url);
    }
  }
}
