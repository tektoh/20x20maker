<?php
App::uses('AppController', 'Controller');

class PagesController extends AppController {

	public $uses = [];

  public function beforeFilter() {
  }

	public function index() {
    return $this->redirect('/mypage');
	}
}
