<div class="container">
  <div class="page-header">
    <h1>20x20maker::Login</h1>
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
  <?php echo $this->Form->input('username', [
    'placeholder' => 'Name',
  ]); ?>
  <?php echo $this->Form->input('password', [
    'placeholder' => 'Password',
  ]); ?>
  <div class="form-group">
    <div class="col col-md-9 col-md-offset-3">
      <?php echo $this->Form->submit('Login', [
        'div' => false,
        'class' => 'btn btn-default',
      ]); ?>
      <a href="/register" class="btn btn-default">Register</a>
    </div>
  </div>
  <?php echo $this->Form->end(); ?>
</div>
