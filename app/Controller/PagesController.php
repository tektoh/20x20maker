<?php
App::uses('AppController', 'Controller');

class PagesController extends AppController {

	public $uses = [];

  public function beforeFilter() {
    $this->Auth->allow(['index']);
  }

	public function index() {
	}
}
