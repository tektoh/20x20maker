<?php
App::uses('AppController', 'Controller');

class ImagesController extends AppController {

	public function add() {
    if ($this->request->is('post')) {

      $count           = count($this->request->data['Image']['files']);
      $presentation_id = $this->request->data['Image']['presentation_id'];
      $order           = $this->Image->orderMax($presentation_id);

      foreach ($this->request->data['Image']['files'] as $i => $file) {
        $image                    = $this->Image->thumbnail($file);
        $image['presentation_id'] = $presentation_id;
        $image['order']           = ++$order;
        $this->Image->create();
        if (!$this->Image->save(['Image' => $image])) {
          throw new InternalErrorException();
        }
      }
      $this->Session->setFlash("{$count} images uploaded.", 'alert', ['plugin' => 'BoostCake', 'class' => 'alert-success']);
      return $this->redirect($this->referer());
    } else {
      throw new BadRequestException();
    }
  }

  public function rotate($image_id, $rotate) {
    $image = $this->Image->findById($image_id);
    if (empty($image)) {
      throw new NotFoundException();
    }
    $this->Image->rotate($image, $rotate);
    return $this->redirect($this->referer());
  }

  public function up($image_id) {
    $image = $this->Image->findById($image_id);
    if (empty($image)) {
      throw new NotFoundException();
    }
    $this->Image->up($image);
    return $this->redirect($this->referer());
  }

  public function down($image_id) {
    $image = $this->Image->findById($image_id);
    if (empty($image)) {
      throw new NotFoundException();
    }
    $this->Image->down($image);
    return $this->redirect($this->referer());
  }

  public function delete($image_id) {
    if ($this->request->is('post')) {
      $image = $this->Image->findById($image_id);
      if (empty($image)) {
        throw new NotFoundException();
      }

      $this->Image->deleteImage($image);
      $this->Image->delete($image_id);

      $this->Session->setFlash("Image #{$image_id} deleted.", 'alert', ['plugin' => 'BoostCake', 'class' => 'alert-success']);
      return $this->redirect($this->referer());
    } else {
      throw new BadRequestException();
    }
  }
}
