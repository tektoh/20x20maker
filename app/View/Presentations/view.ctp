<?php
$this->Html->css('camera', array('inline' => false));
$this->Html->script('//code.jquery.com/jquery-1.11.0.min.js', array('inline' => false));
$this->Html->script('//code.jquery.com/jquery-migrate-1.2.1.min.js', array('inline' => false));
$this->Html->script('//code.jquery.com/ui/1.10.4/jquery-ui.min.js', array('inline' => false));
$this->Html->script('camera.min', array('inline' => false));
$this->Html->scriptStart(array('inline' => false));
$count = count($images);
$script = <<<EOT
$(document).ready(function() {
  $("#start").on('click', function() {
    $("#jumbotron").hide();

    var index = 0;

    $('#slide').camera({
      thumbnails: true,
      time: 20000,
      hover: false,
      portrait: true,
      fx: 'scrollLeft',
      slideOn: 'next',
      onEndTransition: function(){
        if (index++ >= {$count}) {
          $('#slide').cameraStop();
        }
      }
    });
  });
});
EOT;
echo $script;
$this->Html->scriptEnd();
?>
<div id="slide" class="camera_wrap">
  <?php foreach ($images as $image): ?>
  <div data-src="<?= $image['Image']['large_url'] ?>" data-thumb="<?= $image['Image']['thumb_url'] ?>"></div>
  <?php endforeach ?>    
</div>
<div id="jumbotron" class="jumbotron">
  <div class="container">
    <h1><?= $presentation['Presentation']['title'] ?></h1>
    <p><a href="#" id="start" class="btn btn-primary btn-lg">Start</a></p>
  </div>
</div>
