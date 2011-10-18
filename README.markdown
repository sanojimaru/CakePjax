PJAX for CakePHP1.3+
===================

Integrate Chris Wanstrath's [PJAX](https://github.com/defunkt/jquery-pjax) into CakePHP1.3+.

To activate,
1. Add submodule to your project.
``git submodule add git@github.com:sanojimaru/cakephp-pjax-plugin.git app/plugins/pjax``

2. Include PjaxComponent and PjaxHelper in your AppController.
``
<?php
class AppController extends Controller {
  public $helpers = array('Pjax.Pjax');
  public $uses = array('Pjax.Pjax');
}
``

3. Add this to your app/views/layouts/default.cto (or whatever using layout file.)
    <?php echo $this->Pjax->start(); ?>

All links that match `$('a:not([data-remote]):not([data-behavior]):not([data-skip-pjax])')` will then use PJAX.

The PJAX container has to be marked with data-pjax-container attribute, so for example:

<head>
  <?php echo $this->Html->charset(); ?>
  <title>
    <?php __('CakePHP: the rapid development php framework:'); ?>
    <?php echo $title_for_layout; ?>
  </title>
  <?php
    echo $this->Html->meta('icon');

    echo $this->Html->css('cake.generic');


    echo $scripts_for_layout;
  ?>
</head>

    <body>
      <div>
        <!-- This will not be touched on PJAX updates -->
        <?php echo date(); ?>
      </div>

      <div data-pjax-container>
        <!-- PJAX updates will go here -->
        <h3>My site</h3>
        <?php echo $this->Html->link('About me', array('controller' => 'pages', 'action' => 'about_me'));
        <!-- The following link will not be pjax'd -->
        <?php echo $this->Html->link('Google', 'http://google.com', array('data-skip-pjax' => true)); ?>
      </div>
    </body>


FIXME: Currently the layout is hardcoded to "application". Need to delegate that to the specific layout of the controller.

Examples for PjaxComponent::redirect
-----------------------------

class PostsController extends AppController {
  public function view($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid post', true));
      $this->Pjax->redirect(array('action' => 'index'));
    }
    $this->set('post', $this->Post->read(null, $id));
  }
}

# Thanks
This plugin was created based on [pjax-rails](https://github.com/rails/pjax_rails).



author: @sanojimaru (sanojimaru@gmail.com)
ZZZzzz....
