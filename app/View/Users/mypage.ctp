<div class="container">
    <div class="page-header">
        <div class="pull-right"><a class="btn btn-link" href="/logout">ログアウト</a></div>
        <h1>20x20maker</h1>
    </div>
    <h3><?= $user['User']['username']; ?>のペチャクチャ一覧</h3>
    <?php if (empty($user['Presentation'])): ?>
        <div class="alert alert-info">
            ペチャクチャがまだありません。
        </div>
    <?php endif ?>
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
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#addPresentationModal">
                新規作成
            </button>
        </div>
    </div>
</div>

<?php echo $this->Form->create('Presentation', [
    'controller' => 'presentations',
    'action'     => 'add',
    'inputDefaults' => [
        'label'     => false,
        'div' => false,
        'wrapInput' => false,
        'class'     => 'form-control'
    ],
]);
echo $this->Form->hidden('user_id', [
    'value'  => $user['User']['id']
]); ?>
<div class="modal fade" id="addPresentationModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">タイトルを入力してください</h4>
            </div>
            <div class="modal-body">

                <?php echo $this->Form->input('title', [
                    'placeholder' => 'Title',
                ]); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <?php echo $this->Form->submit('新規作成', [
                    'class' => 'btn btn-primary',
                    'div' => false,
                ]); ?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php echo $this->Form->end(); ?>