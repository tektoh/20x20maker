<div class="container">
  <div class="page-header">
    <h1>Edit: <?= $presentation['Presentation']['title'] ?></h1>
  </div>

  <ul class="pager">
    <li class="previous"><a href="/mypage">&larr; Back to mypage</a></li>
  </ul>

  <table class="table">
  <?php $i = 0; foreach ($images as $image): $i++; ?>
    <tr>
      <td>
        #<?= $i ?>
      </td>
      <td>
        <div class="thumbnail"><img src="<?= $image['Image']['thumb_url'] ?>"></div>
      </td>
      <td>
        <div><?php echo $this->Html->link('Up',
          ['controller' => 'images','action' => 'up', $image['Image']['id']],
          null); ?></div>
        <div><?php echo $this->Html->link('Down',
          ['controller' => 'images', 'action' => 'down', $image['Image']['id']],
          null); ?></div>
        <div><?php echo $this->Html->link('Rotate 90',
          ['controller' => 'images', 'action' => 'rotate', $image['Image']['id'], 90],
          null); ?></div>
        <div><?php echo $this->Html->link('Rotate -90',
          ['controller' => 'images', 'action' => 'rotate', $image['Image']['id'], -90],
          null); ?></div>
        <div><?php echo $this->Html->link('Rotate 180',
          ['controller' => 'images', 'action' => 'rotate', $image['Image']['id'], 180],
          null); ?></div>
        <div><?php echo $this->Form->postLink('Delete', ['controller' => 'images', 'action' => 'delete', $image['Image']['id']],
          null, 'Are you sure you want to delete the image?'); ?></div>
    </tr>
  <?php endforeach ?>
  </table>

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
    <li class="previous"><a href="/mypage">&larr; Back to mypage</a></li>
  </ul>

</div>
