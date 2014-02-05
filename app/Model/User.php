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
      $this->data[$this->alias]['salt']     = $this->salt();
      $this->data[$this->alias]['password'] = $this->hash($this->data[$this->alias]['password'], $this->data[$this->alias]['salt']);
    }
    if (isset($this->data[$this->alias]['username'])) {
      $this->data[$this->alias]['username'] = Sanitize::html($this->data[$this->alias]['username']);
    }
    if (!isset($this->data[$this->alias]['id']) && !isset($this->data[$this->alias]['role'])) {
      $this->data[$this->alias]['role'] = 'user';
    }
    return true;
  }

  public function salt() {
    return vsprintf('$2a$%02d$%s', [Security::$hashCost, bin2hex(openssl_random_pseudo_bytes(22))]);
  }

  public function hash($password, $salt) {
    return Security::hash(Security::hash($password, 'sha256', true), 'blowfish', $salt);
  }

  public function auth($data, $fields = null, $order = null, $recursive = -1) {
    $user = $this->findByUsername($data['User']['username'], $fields, $order, $recursive);
    if (empty($user)) {
      $this->log('User->findByName Error: ' . $data['User']['username']);
      return false;
    }
    if ($user['User']['password'] != $this->hash($data['User']['password'], $user['User']['salt'])) {
      $this->log('User->hash Error: ' . $data['User']['username']);
      return false;
    }
    return $user;
  }
}
