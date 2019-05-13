<?php

$this->block('blocks/head',     $_);
$this->block('blocks/nav',      $_);
$this->block('blocks/banner',   $_);
$this->block('blocks/begin',    $_);
$this->block('contents/'.$page, $_);
$this->block('blocks/end',      $_);
$this->block('blocks/footer',   $_);

?>