<?php
$this->Html->css('camera', array('inline' => false));
$this->Html->script('//code.jquery.com/jquery-1.11.0.min.js', array('inline' => false));
$this->Html->script('//code.jquery.com/jquery-migrate-1.2.1.min.js', array('inline' => false));
$this->Html->script('//code.jquery.com/ui/1.10.4/jquery-ui.min.js', array('inline' => false));
$this->Html->script('camera.min', array('inline' => false));
$this->Html->scriptStart(array('inline' => false));
$script = <<<EOT
$(document).ready(function() {
  jQuery('#slide').camera({
    thumbnails: true,
    time: 20000,
    portrait: true,
    fx: 'scrollLeft'
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
