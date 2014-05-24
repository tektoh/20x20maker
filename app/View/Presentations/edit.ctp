<div class="container">
  <div class="page-header">
    <div class="pull-right"><a class="btn btn-link" href="/logout">ログアウト</a></div>
    <h1>20x20maker</h1>
  </div>
  <ul class="pager">
    <li class="previous"><a href="/mypage">&larr; 戻る</a></li>
  </ul>
  <h2><?= $presentation['Presentation']['title'] ?></h2>
  <?php foreach ($images as $i => $image):?>
    <?php if ($i % 3 == 0): ?>
        <?php if ($i > 0): ?>
            </div>
        <?php endif ?>
        <div class="row">
    <?php endif ?>
    <div class="col-xs-12 col-md-4">
      <div class="thumbnail">
        <img src="<?= $image['Image']['thumb_url'] ?>">
        <div class="caption">
          <p class="text-center">#<?= $i ?></p>
          <div class="row">
            <div class="col-xs-2 text-center">
                <?php echo $this->Html->link('<i class="fa fa-arrow-up"></i>',
                    ['controller' => 'images','action' => 'up', $image['Image']['id']],
                    ['class' => 'btn btn-link btn-block', 'escape' => false]); ?>
            </div>
            <div class="col-xs-2 text-center">
                <?php echo $this->Html->link('<i class="fa fa-arrow-down"></i>',
                    ['controller' => 'images', 'action' => 'down', $image['Image']['id']],
                    ['class' => 'btn btn-link btn-block', 'escape' => false]); ?>
            </div>
            <div class="col-xs-2 text-center">
                <?php echo $this->Html->link('<i class="fa fa-rotate-left"></i>',
                    ['controller' => 'images', 'action' => 'rotate', $image['Image']['id'], 270],
                    ['class' => 'btn btn-link btn-block', 'escape' => false]); ?>
            </div>
            <div class="col-xs-2 text-center">
                <?php echo $this->Html->link('<i class="fa fa-rotate-right"></i>',
                    ['controller' => 'images', 'action' => 'rotate', $image['Image']['id'], 90],
                    ['class' => 'btn btn-link btn-block', 'escape' => false]); ?>
            </div>
            <div class="col-xs-offset-2 col-xs-2 text-center">
                <?php echo $this->Form->postLink('<i class="fa fa-trash-o"></i>',
                    ['controller' => 'images', 'action' => 'delete', $image['Image']['id']],
                    ['class' => 'btn btn-link', 'escape' => false],
                    'Are you sure you want to delete the image?'); ?></div>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach ?>
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
  <legend>画像のアップロード</legend>
  <?php echo $this->Form->input('files.', [
    'type'       => 'file',
    'afterInput' => "<span class=\"help-block\">Upload max filesize: {$upload_max_filesize}, Post max size: {$post_max_size}</span>",
    'accept'     => "image/jpeg,image/png",
    'multiple'
  ]);
  echo $this->Form->hidden('presentation_id', [
    'value'  => $presentation['Presentation']['id']
  ]);
  ?>
  <?php echo $this->Form->submit('Upload', [
    //'div'   => 'form-group',
    'class' => 'btn btn-default'
  ]); ?>
  <?php echo $this->Form->end(); ?>

  <hr>

  <ul class="pager">
    <li class="previous"><a href="/mypage">&larr; 戻る</a></li>
  </ul>

</div>
