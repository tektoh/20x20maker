<?php
App::uses('AppController', 'Controller');

class ImagesController extends AppController {

	public function add() {
    if ($this->request->is('post')) {

      $imagine = new Imagine\Imagick\Imagine();
      $large   = new Imagine\Image\Box(1440, 1440);
      $thumb   = new Imagine\Image\Box(300, 300);
      $mode    = Imagine\Image\ImageInterface::THUMBNAIL_INSET;
      
      foreach ($this->request->data['Image']['files'] as $i => $file) {
        $imagine->open($file['tmp_name'])->thumbnail($large, $mode)->save("/tmp/large{$i}.jpg");
        $imagine->open($file['tmp_name'])->thumbnail($thumb, $mode)->save("/tmp/thumb{$i}.jpg");
      }

      $this->Image->create();
      if (true) {
        $this->Session->setFlash('Success', 'alert', ['plugin' => 'BoostCake', 'class' => 'alert-success']);
      } else {
        $this->Session->setFlash('Failed', 'alert', ['plugin' => 'BoostCake', 'class' => 'alert-danger']);
      }
      return $this->redirect($this->referer());
    } else {
      throw new BadRequestException();
    }
  }
}
