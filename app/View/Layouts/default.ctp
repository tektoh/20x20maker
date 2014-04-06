<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>20x20maker::<?= $title ?></title>
	<?php
		echo $this->fetch('meta');

    echo $this->Html->css('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css');
    echo $this->Html->css('//netdna.bootstrapcdn.com/bootswatch/3.1.1/simplex/bootstrap.min.css');
    echo $this->Html->css('//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css');
    echo $this->Html->css('//fonts.googleapis.com/css?family=Allura');
    echo $this->Html->css('style.css');
		echo $this->fetch('css');
	?>
</head>
<body>
  <div class="container"><?php echo $this->Session->flash(); ?></div>
	<?php echo $this->fetch('content'); ?>
	<?php echo $this->element('sql_dump'); ?>
  <?php
    echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js');
    echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js');
    echo $this->Html->script('//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js');
    echo $this->fetch('script');
  ?>
</body>
</html>
