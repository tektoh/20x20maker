<div class="container">
  <div class="page-header">
    <div class="pull-right"><a class="btn btn-link" href="/logout">ログアウト</a></div>
    <h1>20x20maker</h1>
  </div>
  <h2><?= $user['User']['username']; ?>のペチャクチャ一覧</h2>
  <?php foreach ($user['Presentation'] as $presentation): ?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">#<?= $presentation['id'] ?> <?= $presentation['title'] ?></h3>
      <ul class="nav nav-pills">
        <li class="<?php if (empty($presentation['Image'])) echo "disabled";?>">
          <?php echo $this->Html->link('開始', ['controller' => 'presentations', 'action' => 'view', $presentation['id']]); ?></li>
        <li><?php echo $this->Html->link('編集', ['controller' => 'presentations', 'action' => 'edit', $presentation['id']]); ?></li>
        <li><?php echo $this->Form->postLink('削除', ['controller' => 'presentations', 'action' => 'delete', $presentation['id']],
          null, 'Are you sure you want to delete the presentation?'); ?></li>
      </ul>
    </div>
    <div class="panel-body">
      <?php foreach ($presentation['Image'] as $image): ?>
        <img src="<?= $image['Image']['icon_url'] ?>">
      <?php endforeach ?>
    </div>
  </div>
  <?php endforeach ?>
  <button class="btn btn-link btn-block"  data-toggle="modal" data-target="#addPresentationModal">新規作成</button></td></tr>
</div>

<div class="modal fade" id="addPresentationModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <p>ペチャクチャのタイトルを入力してください</p>
        <?php echo $this->Form->create('Presentation', [
          'controller' => 'presentations',
          'action'     => 'add',
          'inputDefaults' => [
            'div'       => 'form-group',
            'label'     => false,
            'wrapInput' => false,
            'class'     => 'form-control'
          ],
          'class' => 'form-inline'
        ]);
        echo $this->Form->input('title', [
          'placeholder' => 'Title'
        ]);
        echo $this->Form->hidden('user_id', [
          'value'  => $user['User']['id']
        ]);
        ?>
        <?php echo $this->Form->submit('OK', [
          'div'   => 'form-group',
          'class' => 'btn btn-default'
        ]); ?>
        <?php echo $this->Form->end(); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
