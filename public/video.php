<?php if(empty($_GET['url'])) die(); ?>
<link href="web/css/video-js.css" rel="stylesheet">
<script src="web/js/video.js"></script>
<script src="web/js/videojs-contrib-hls.js"></script>
<video id="my_video_1" class="video-js vjs-default-skin" preload="auto" controls="controls" data-setup="{}">
    <source src="<?= $_GET['url'] ?>" type="application/x-mpegURL" />
</video>
<style>
    #my_video_1{width:100%; height:100%}
</style>
