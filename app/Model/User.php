<?php
App::uses('AppModel', 'Model');
App::uses('Sanitize', 'Utility');

class User extends AppModel {

	public $displayField = 'username';

  public $hasMany = ['Presentation'];

  public $actsAs  = ['Password'];

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
    if (isset($this->data[$this->alias]['username'])) {
      $this->data[$this->alias]['username'] = Sanitize::html($this->data[$this->alias]['username']);
    }
    if (!isset($this->data[$this->alias]['id']) && !isset($this->data[$this->alias]['role'])) {
      $this->data[$this->alias]['role'] = 'user';
    }
    return true;
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
