<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>20x20maker</title>
	<?php
		echo $this->fetch('meta');

    echo $this->Html->css('//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css');
    echo $this->Html->css('//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css');
		echo $this->fetch('css');
	?>
</head>
<body>
  <div class="container"><?php echo $this->Session->flash(); ?></div>
	<?php echo $this->fetch('content'); ?>
	<?php echo $this->element('sql_dump'); ?>
  <?php
    //echo $this->Html->script('//code.jquery.com/jquery.min.js');
    //echo $this->Html->script('//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js');
    echo $this->fetch('script');
  ?>
</body>
</html>
