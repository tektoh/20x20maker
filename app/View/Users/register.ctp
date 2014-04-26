<div class="container">
  <div class="page-header">
    <h1>20x20maker</h1>
  </div>
  <?php echo $this->Form->create('User', [
    'inputDefaults' => [
      'div' => 'form-group',
      'label' => [
        'class' => 'col col-md-3 control-label'
      ],
      'wrapInput' => 'col col-md-9',
      'class' => 'form-control'
    ],
    'class' => 'well form-horizontal'
  ]); ?>
  <legend>ユーザー登録</legend>
  <?php echo $this->Form->input('username', [
    'placeholder' => 'Name',
  ]); ?>
  <?php echo $this->Form->input('password', [
    'placeholder' => 'Password',
  ]); ?>
  <div class="form-group">
    <?php echo $this->Form->submit('Sign up', [
      'div' => 'col col-md-9 col-md-offset-3',
      'class' => 'btn btn-default',
    ]); ?>
  </div>
  <?php echo $this->Form->end(); ?>
</div>
