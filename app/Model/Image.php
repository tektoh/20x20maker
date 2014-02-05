<?php
App::uses('AppModel', 'Model');

class Image extends AppModel {

  public function thumbnail($file) {
    $directory = $this->derectory();
    if ($directory === false) {
      return false;
    }

    $ext = $file['type'] == "image/jpeg" ? 'jpg' :
           $file['type'] == "image/png"  ? 'png' : false;

    if ($ext === false) {
      return false;
    }

    $uuid    = String::uuid();

    $imagine = new Imagine\Imagick\Imagine();
    $large   = new Imagine\Image\Box(1440, 1440);
    $thumb   = new Imagine\Image\Box(300, 300);
    $mode    = Imagine\Image\ImageInterface::THUMBNAIL_INSET;

    $imagine->open($file['tmp_name'])
      ->thumbnail($large, $mode)
      ->save("{$directory}/{$uuid}_l.{$ext}");

    $imagine->open("{$directory}/{$uuid}_l.{$ext}")
      ->thumbnail($thumb, $mode)
      ->save("{$directory}/{$uuid}_t.{$ext}");
  }

  public function directory() {
    $year  = data('Y');
    $month = data('m');
    $directory = ROOT . DS . APP_DIR . DS . 'webroot' . DS . 'thumbs' . DS . $year . DS . $month;
    return Folder::create($directory) ? $directory : false;
  }
}
