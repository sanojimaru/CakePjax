# PJAX for CakePHP2

Integrate Chris Wanstrath's [PJAX](https://github.com/defunkt/jquery-pjax) into CakePHP2.

## Activate

Add submodule to your project.

``
git submodule add git@github.com:sanojimaru/CakePjax.git app/Plugin/Pjax
``

And modify  your AppController.

``
<?php
class AppController extends Controller {
  public $helpers = array('Pjax.Pjax');
  public $uses = array('Pjax.Pjax');
}
``

All links that match `$('a:not([data-remote]):not([data-behavior]):not([data-skip-pjax])')` will then use PJAX.
The PJAX container has to be marked with data-pjax-container attribute, so for example:


``
<html>
  <head>
    <?php echo $this->Html->charset(); ?>
    <title>
      <?php __('CakePHP: the rapid development php framework:'); ?>
      <?php echo $title_for_layout; ?>
    </title>
    <?php
    echo $this->Html->meta('icon');
    echo $this->Html->css('cake.generic');
    echo $this->Pjax->start();
    echo $scripts_for_layout;
    ?>
  </head>
  <body>
    <div>
      <!-- This will not be touched on PJAX updates -->
      <?php echo date(); ?>
    </div>
    <div data-pjax-container="true">
      <?php echo $content_for_layout; ?>
    </div>
  </body>
</html>
``

## Examples for PjaxComponent::redirect

``
class PostsController extends AppController {
  public function view($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid post', true));
      $this->Pjax->redirect(array('action' => 'index'));
    }
    $this->set('post', $this->Post->read(null, $id));
  }
}
``

## Demo

CakePHP2.0 demo is [here](http://demo.sanojimru.com/).

## Thanks

This plugin was created based on [pjax-rails](https://github.com/rails/pjax_rails).

