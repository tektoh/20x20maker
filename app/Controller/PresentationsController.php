<?php
App::uses('AppController', 'Controller');

class PresentationsController extends AppController {

  public function beforeFilter() {
  }

	public function add() {
    if ($this->request->is('post')) {
      $this->Presentation->create();
      if ($this->Presentation->save($this->request->data)) {
        $this->Session->setFlash('Success', 'alert', ['plugin' => 'BoostCake', 'class' => 'alert-success']);
      } else {
        $this->Session->setFlash('Failed', 'alert', ['plugin' => 'BoostCake', 'class' => 'alert-danger']);
      }
      return $this->redirect($this->referer());
    } else {
      throw new BadRequestException();
    }
  }

  public function edit($presentation_id) {
    $this->set('presentation', $this->Presentation->findById($presentation_id));
  }
}
