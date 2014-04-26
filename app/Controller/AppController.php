<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {
  public $components = [
    'Session',
    'Auth' => [
      'flash' => [
        'element' => 'alert',
        'key'     => 'auth',
        'params'  => [
          'plugin' => 'BoostCake',
          'class' => 'alert-error'
        ]
      ]
    ],
    'DebugKit.Toolbar',
  ];

  public $helpers = array(
    'Session',
    'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
    'Form' => array('className' => 'BoostCake.BoostCakeForm'),
    'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
  );

  public function beforeRender() {
    if (empty($this->viewVars['title'])) {
      $this->viewVars['title'] = '';
    }
  }
}
