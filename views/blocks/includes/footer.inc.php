<?php

$microbe_source_service_name = $this->getConfigValue('microbe.source.service.name');
$microbe_source_service_url  = $this->getConfigValue('microbe.source.service.url');

$microbe_license_type = $this->getConfigValue('microbe.license.type');
$microbe_license_url  = $this->getConfigValue('microbe.license.url');

?>

<div class="microbe-footer">
  <div class="microbe-footer-left">
    Project: <?=$this->getConfigValue('microbe.caption')?>
    <br>
    Version: <?=$this->getConfigValue('microbe.version')?>
    <br>
    Edition: <?=$this->getConfigValue('microbe.edition')?>
    <br>
    Release: <?=$this->getConfigValue('microbe.release.date')?>
    <br>
    Source: <a href="<?=$microbe_source_service_url?>" target="_blank"><?=$microbe_source_service_name?></a>
    <br>
    License: <a href="<?=$microbe_license_url?>" target="_blank"><?=$microbe_license_type?></a>
    <br>
    <br>
    <?=$this->getConfigValue('microbe.copyright')?>
  </div>
  <div class="microbe-footer-right">
  </div>
</div>

<script src="<?=$this->getUrl('./assets/js/microbe.js')?>"></script>

</body>
</html>