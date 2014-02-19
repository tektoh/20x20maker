<?php
App::uses('AppModel', 'Model');
App::uses('Sanitize', 'Utility');
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {

	public $displayField = 'username';

  public $hasMany = ['Presentation'];

	public $validate = [
		'username' => [
			'alphaNumeric' => [
				'rule'    => ['alphaNumeric'],
				'message' => 'ユーザー名は英数字で入力してください',
			],
			'maxLength' => [
				'rule'    => ['maxLength', 32],
				'message' => 'ユーザー名が長すぎます',
			],
      'unique' => [
        'rule' => ['isUnique'],
        'message'  => 'このユーザー名は登録されています'
      ],
		],
		'password' => [
			'notEmpty' => [
				'rule'    => ['notEmpty'],
				'message' => 'パスワードを入力してください',
				'on'      => 'create',
			],
		],
	];

  public function beforeSave($options = []) {
    if (isset($this->data[$this->alias]['password'])) {
      $this->data[$this->alias]['password'] = $this->password_hash($this->data[$this->alias]['password']);
    }
    if (isset($this->data[$this->alias]['username'])) {
      $this->data[$this->alias]['username'] = Sanitize::html($this->data[$this->alias]['username']);
    }
    if (!isset($this->data[$this->alias]['id']) && !isset($this->data[$this->alias]['role'])) {
      $this->data[$this->alias]['role'] = 'user';
    }
    return true;
  }

  public function password_hash($password, $salt = '') {
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

  public function password_verify($password, $hash) {
    $data = explode('/', $hash, 2);
    $salt = $data[0];
    return $hash == $this->password_hash($password, $salt);
  }

  public function auth($data, $fields = null, $order = null, $recursive = -1) {
    $user = $this->findByUsername($data['User']['username'], $fields, $order, $recursive);
    if (empty($user)) {
      $this->log('User->findByName Error: ' . $data['User']['username']);
      return false;
    }
    if (!$this->password_verify($data['User']['password'], $user['User']['password'])) {
      $this->log('User->password_verify Error: ' . $data['User']['username']);
      return false;
    }
    return $user;
  }
}
