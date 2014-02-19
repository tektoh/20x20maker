<?php
/**
 * アプリケーション用スキーマファイル
 *
 * データベースのスキーマを作成する時に使用します
 *
 * @package       app.Config.Schema
 */

/*
 *
 * Using the Schema command line utility
 * cake schema create DbApp
 *
 */
class DbAppSchema extends CakeSchema {

  public function before($event = array()) {
    return true;
  }

  public function after($event = array()) {
  }

  public $users = [
    'id' => [
      'type'    => 'integer',
      'null'    => false,
      'default' => null,
      'length'  => 10,
      'key'     => 'primary'
    ],
		'username' => [
      'type'    => 'string',
      'null'    => false,
      'default' => null,
      'length'  => 50
    ],
		'password' => [
      'type'    => 'string',
      'null'    => false,
      'default' => null,
      'length'  => 255
    ],
    'role' => [
      'type'    => 'string',
      'null'    => false,
      'default' => null,
      'length'  => 10
    ],
		'indexes' => [
      'PRIMARY' => [
        'column' => 'id',
        'unique' => 1
      ]
    ]
	];

  public $presentations = [
    'id' => [
      'type'    => 'integer',
      'null'    => false,
      'default' => null,
      'length'  => 10,
      'key'     => 'primary'
    ],
    'title' => [
      'type'    => 'string',
      'null'    => false,
      'default' => null,
      'length'  => 50
    ],
    'user_id' => [
      'type'    => 'integer',
      'null'    => false,
      'default' => null,
      'length'  => 10
    ],
    'indexes' => [
      'PRIMARY' => [
        'column' => 'id',
        'unique' => 1
      ]
    ]
  ];

  public $images = [
    'id' => [
      'type'    => 'integer',
      'null'    => false,
      'default' => null,
      'length'  => 10,
      'key'     => 'primary'
    ],
    'presentation_id' => [
      'type'    => 'integer',
      'null'    => false,
      'default' => null,
      'length'  => 10
    ],
    'order' => [
      'type'    => 'integer',
      'null'    => false,
      'default' => null,
      'length'  => 10
    ],
    'directory' => [
      'type'    => 'string',
      'null'    => false,
      'default' => null,
      'length'  => 100
    ],
    'path' => [
      'type'    => 'string',
      'null'    => false,
      'default' => null,
      'length'  => 100
    ],
    'uuid' => [
      'type'    => 'string',
      'null'    => false,
      'default' => null,
      'length'  => 36
    ],
    'extension' => [
      'type'    => 'string',
      'null'    => false,
      'default' => null,
      'length'  => 10
    ],
    'indexes' => [
      'PRIMARY' => [
        'column' => 'id',
        'unique' => 1
      ]
    ]
  ];
}
