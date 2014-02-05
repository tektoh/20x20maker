<?php
App::uses('AppModel', 'Model');

class Presentation extends AppModel {

	public $displayField = 'title';

  public $hasMany = ['Image'];

	public $validate = [
		'title' => [
			'maxLength' => [
				'rule'    => ['maxLength', 50],
				'message' => 'タイトルが長すぎます',
			],
    ]
	];
}
