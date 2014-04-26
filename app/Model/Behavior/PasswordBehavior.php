<?php

class PasswordBehavior extends ModelBehavior {

  public function beforeSave(Model $model, $options = []) {
    if (isset($model->data[$model->alias]['password'])) {
      $model->data[$model->alias]['password'] = $this->password_hash($model, $model->data[$model->alias]['password']);
    }
    return true;
  }

  public function password_hash(Model $model, $password, $salt = '') {
    if (empty($salt)) {
      $chrlist = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
      $salt = vsprintf('$2y$%02d$', [Security::$hashCost]);
      for ($i = 0; $i < 22; $i++) {
        $random = array_rand($chrlist);
        $salt .= $chrlist[$random];
      }
    }
    $password = Security::hash($password, 'sha256', true);
    $hash     = crypt($password, $salt);
    return "{$salt}/{$hash}";
  }

  public function password_verify(Model $model, $password, $hash) {
    $data = explode('/', $hash, 2);
    $salt = $data[0];
    return $hash == $this->password_hash($model, $password, $salt);
  }

}
