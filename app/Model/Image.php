<?php
App::uses('AppModel', 'Model');
App::uses('Folder', 'Utility');

class Image extends AppModel {

  const SIZE_ICON  = "i";
  const SIZE_THUMB = "t";
  const SIZE_LARGE = "l";

  public function thumbnail($file) {
    $year      = date('Y');
    $month     = date('m');
    $path      = $this->path($year, $month);
    $directory = $this->directory($year, $month);
    if ($directory === false) {
      return false;
    }

    if      ($file['type'] == "image/jpeg") $extension = "jpg";
    else if ($file['type'] == "image/png")  $extension = "png";
    else                                    $extension = false;

    if ($extension === false) {
      return false;
    }

    if ($extension == "jpg") {
      $rotate = $this->getExifRotate($file['tmp_name']);
    } else {
      $rotate = 0;
    }

    $uuid    = String::uuid();

    $imagine = new Imagine\Imagick\Imagine();
    $large   = new Imagine\Image\Box(1440, 1440);
    $thumb   = new Imagine\Image\Box(300, 300);
    $icon    = new Imagine\Image\Box(20,20);
    $mode    = Imagine\Image\ImageInterface::THUMBNAIL_INSET;

    $imagine->open($file['tmp_name'])
      ->rotate($rotate)
      ->thumbnail($large, $mode)
      ->save($this->getLargeImage($directory, $uuid, $extension));

    $imagine->open($this->getLargeImage($directory, $uuid, $extension))
      ->thumbnail($thumb, $mode)
      ->save($this->getThumbImage($directory, $uuid, $extension));

    $imagine->open($this->getThumbImage($directory, $uuid, $extension))
      ->thumbnail($icon, Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND)
      ->save($this->getIconImage($directory, $uuid, $extension));

    return compact('path', 'directory', 'uuid', 'extension');
  }

  public function getExifRotate($file) {
    $exif = exif_read_data($file);
    if (!empty($exif) && !empty($exif['Orientation'])) {
      switch ($exif['Orientation']) {
      case 8: return 90;
      case 3: return 180;
      case 6: return -90;
      }
    }
    return 0;
  }

  public function path($year, $month) {
    return "/thumbs/{$year}/{$month}";
  }

  public function directory($year, $month) {
    $directory = ROOT . DS . APP_DIR . DS . 'webroot' . DS . 'thumbs' . DS . $year . DS . $month;
    $folder = new Folder();
    return $folder->create($directory) ? $directory : false;
  }

  public function getImagePath($directory, $uuid, $size, $extension) {
    return "{$directory}/{$uuid}_{$size}.{$extension}";
  }

  public function getIconImage() {
    if (func_num_args() == 3) {
      $directory = func_get_arg(0);
      $uuid      = func_get_arg(1);
      $extension = func_get_arg(2);
    } else {
      $image = func_get_arg(0);
      if (isset($image['Image'])) {
        $image = $image['Image'];
      }
      $directory = $image['directory'];
      $uuid      = $image['uuid'];
      $extension = $image['extension'];
    }
    return $this->getImagePath($directory, $uuid, self::SIZE_ICON, $extension);
  }

  public function getThumbImage() {
    if (func_num_args() == 3) {
      $directory = func_get_arg(0);
      $uuid      = func_get_arg(1);
      $extension = func_get_arg(2);
    } else {
      $image = func_get_arg(0);
      if (isset($image['Image'])) {
        $image = $image['Image'];
      }
      $directory = $image['directory'];
      $uuid      = $image['uuid'];
      $extension = $image['extension'];
    }
    return $this->getImagePath($directory, $uuid, self::SIZE_THUMB, $extension);
  }

  public function getLargeImage() {
    if (func_num_args() == 3) {
      $directory = func_get_arg(0);
      $uuid      = func_get_arg(1);
      $extension = func_get_arg(2);
    } else {
      $image = func_get_arg(0);
      if (isset($image['Image'])) {
        $image = $image['Image'];
      }
      $directory = $image['directory'];
      $uuid      = $image['uuid'];
      $extension= $image['extension'];
    }
    return $this->getImagePath($directory, $uuid, self::SIZE_LARGE, $extension);
  }

  public function getUrlPath($image, $size) {
    if (isset($image['Image'])) {
      $image = $image['Image'];
    }
    $path      = $image['path'];
    $uuid      = $image['uuid'];
    $extension = $image['extension'];
    return "{$path}/{$uuid}_{$size}.{$extension}";
  }

  public function getIconUrl($image) {
    return $this->getUrlPath($image, self::SIZE_ICON);
  }

  public function getThumbUrl($image) {
    return $this->getUrlPath($image, self::SIZE_THUMB);
  }

  public function getLargeUrl($image) {
    return $this->getUrlPath($image, self::SIZE_LARGE);
  }

  public function orderMax($presentation_id) {
    $image = $this->findByPresentationId($presentation_id, null, 'Image.order DESC', -1);

    if (empty($image)) {
      return 0;
    } else {
      return $image['Image']['order'];
    }
  }

  public function swap($image1, $image2) {
      $tmp_order = $image1['Image']['order'];
      $image1['Image']['order'] = $image2['Image']['order'];
      $image2['Image']['order'] = $tmp_order;
      $this->create();
      $this->save($image1);
      $this->create();
      $this->save($image2);
  }

  public function up($image1) {
    $image2 = $this->find('first', [
      'conditions' => [
        'Image.presentation_id' => $image1['Image']['presentation_id'],
        'Image.order <'         => $image1['Image']['order'],
      ],
      'order' => [
        'Image.order' => 'DESC'
      ]
    ]);
    if (!empty($image2)) {
      $this->swap($image1, $image2);
    }
  }

  public function down($image1) {
    $image2 = $this->find('first', [
      'conditions' => [
        'Image.presentation_id' => $image1['Image']['presentation_id'],
        'Image.order >'         => $image1['Image']['order'],
      ],
      'order' => [
        'Image.order' => 'ASC'
      ]
    ]);
    if (!empty($image2)) {
      $this->swap($image1, $image2);
    }
  }

  public function rotate($image, $rotate = 90) {
    $imagine = new Imagine\Imagick\Imagine();
    $large = $this->getLargeImage($image);
    $thumb = $this->getThumbImage($image);
    $icon  = $this->getIconImage($image);
    $imagine->open($large)->rotate($rotate)->save($large);
    $imagine->open($thumb)->rotate($rotate)->save($thumb);
    $imagine->open($icon)->rotate($rotate)->save($icon);
  }

  public function deleteImage($image) {
    $file = new File($this->getIconImage($image));
    $file->delete();
    $file = new File($this->getLargeImage($image));
    $file->delete();
    $file = new File($this->getThumbImage($image));
    $file->delete();
  }
}
