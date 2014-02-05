<div class="container">
  <div class="page-header">
    <h1><?= $user['User']['username']; ?>さんのマイページ</h1>
  </div>

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
  <?php echo $this->Form->submit('New Presentation', [
    'div'   => 'form-group',
    'class' => 'btn btn-default'
  ]); ?>
  <?php echo $this->Form->end(); ?>

  <h2>Presentations</h2>

  <?php if (isset($user['Presentation'])): ?>
  <table class="table table-hover">
	  <?php foreach ($user['Presentation'] as $presentation): ?>
    <tr>
      <th>
        <?php echo $this->Html->link($presentation['title'], ['controller' => 'presentations', 'action' => 'view', $presentation['id']]); ?>
      </th>
      <td>
        <?php echo $this->Html->link('Edit', ['controller' => 'presentations', 'action' => 'edit', $presentation['id']]); ?>
      </td>
      <td><a href="#">Delete</a></td>
    </tr>
    <?php endforeach ?>
  </table>
  <?php endif ?>
</div>
