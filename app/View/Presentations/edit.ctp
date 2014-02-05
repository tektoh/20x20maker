<div class="container">
  <div class="page-header">
    <h1>Edit: <?= $presentation['Presentation']['title'] ?></h1>
  </div>

  <?php echo $this->Form->create('Image', [
    'controller' => 'images',
    'action'     => 'add',
    'type'       => 'file',
    'enctype'    => 'multipart/form-data',
    'inputDefaults' => [
      'div'       => 'form-group',
      'label'     => false,
      'wrapInput' => false,
      'class'     => 'form-control'
    ],
    'class' => 'form-inline'
  ]); ?>
  <legend>Upload images</legend>
  <?php echo $this->Form->input('files.', [
    'type'     => 'file',
    'multiple'
  ]);
  echo $this->Form->hidden('presentation_id', [
    'value'  => $presentation['Presentation']['id']
  ]);
  ?>
  <?php echo $this->Form->submit('Upload', [
    'div'   => 'form-group',
    'class' => 'btn btn-default'
  ]); ?>
  <?php echo $this->Form->end(); ?>

  <hr>

  <div class="list-group">
    <a class="list-group-item" href="/mypage">Back to mypage</a>
  </div>
</div>
