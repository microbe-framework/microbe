<?php

use \Microbe\Library\DateTimes as DateTimes;

$request = $this->app->getRequest();
$timer = $this->app->getTimer();

$microbe_source_service_name = $cfg->get('microbe.source.service.name');
$microbe_source_service_url  = $cfg->get('microbe.source.service.url');

$microbe_license_type = $cfg->get('microbe.license.type');
$microbe_license_url  = $cfg->get('microbe.license.url');

?>

<div class="app-footer-spacer">
</div>

<div class="app-footer">
  <div class="app-footer-left">
    Project: <?=$cfg->get('microbe.caption')?>
    <br>
    Version: <?=$cfg->get('microbe.version')?> (<?=$cfg->get('microbe.edition')?>)
    <br>
    Release: <?=$cfg->get('microbe.release.date')?>
    <br>
    Source: <a href="<?=$microbe_source_service_url?>" target="_blank"><?=$microbe_source_service_name?></a>
    <br>
    License: <a href="<?=$microbe_license_url?>" target="_blank"><?=$microbe_license_type?></a>
  </div>
  <div class="app-footer-right">
    Today: <?=DateTimes::getDateTimeString()?>
    <br>
    Request ip: <?=$request->getIp()?>:<?=$request->getPort()?>
    <br>
<!--Request uri: <?=$request->getUri()?>
    <br>
    Agent: <?=$request->getUserAgent()?>
    <br>
    Referer: <?=$request->getReferer()?>
    <br>-->
    Request time: <?=$timer->getStartTimeEx()?>
    <br>
    Timelapse: <?=$timer->getMicroSeconds()?> microseconds
    <br>
  </div>
  <div class="app-footer-bottom">
    <?=$cfg->get('microbe.copyright')?>
  </div>
</div>

<script src="<?=$this->getUrl('./assets/js/microbe.js')?>"></script>

</body>
</html>