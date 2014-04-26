<?php
App::uses('AppController', 'Controller');

class PresentationsController extends AppController {

  public $uses = ['Presentation', 'Image'];

  public function beforeFilter() {
    $this->Auth->allow('view');
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
    $post_max_size       = ini_get('post_max_size');
    $upload_max_filesize = ini_get('upload_max_filesize');
    $presentation        = $this->Presentation->findById($presentation_id, null, null, -1);
    $images              = $this->Image->find('all', [
      'conditions' => ['Image.presentation_id' => $presentation_id],
      'order'      => ['Image.order' => 'ASC'],
      'limit'      => 100,
      'recursive'  => -1,
    ]);

    foreach ($images as $i => $image) {
      $images[$i]['Image']['large_url'] = $this->Image->getLargeUrl($image);
      $images[$i]['Image']['thumb_url'] = $this->Image->getThumbUrl($image);
    }

    $this->set(compact('presentation', 'images', 'post_max_size', 'upload_max_filesize'));
  }

  public function view($presentation_id) {
    $presentation = $this->Presentation->findById($presentation_id, null, null, -1);
    $images       = $this->Image->find('all', [
      'conditions' => ['Image.presentation_id' => $presentation_id],
      'order'      => ['Image.order' => 'ASC'],
      'limit'      => 100,
      'recursive'  => -1,
    ]);

    foreach ($images as $i => $image) {
      $images[$i]['Image']['large_url'] = $this->Image->getLargeUrl($image);
      $images[$i]['Image']['thumb_url'] = $this->Image->getThumbUrl($image);
    }

    $this->set(compact('presentation', 'images'));
  }

  public function delete($presentation_id) {
    if ($this->request->is('post')) {
      $presentation = $this->Presentation->findById($presentation_id, null, null, -1);
      if (empty($presentation)) {
        throw new NotFoundException();
      }
      $images = $this->Image->find('all', [
        'conditions' => ['Image.presentation_id' => $presentation_id],
        'order'      => ['Image.order' => 'ASC'],
        'limit'      => 100,
        'recursive'  => -1,
      ]);
      foreach ($images as $image) {
        $this->Image->deleteImage($image);
        $this->Image->delete($image['Image']['id']);
      }
      $this->Presentation->delete($presentation_id);
      $this->Session->setFlash("Presentation #{$presentation_id} deleted.", 'alert', ['plugin' => 'BoostCake', 'class' => 'alert-success']);
      return $this->redirect($this->referer());
    } else {
      throw new BadRequestException();
    }
  }
}
