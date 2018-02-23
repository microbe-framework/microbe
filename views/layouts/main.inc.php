<?php

$this->block('includes/header', $_);
$this->block('includes/nav',    $_);
$this->block('pages/'.$page,    $_);
$this->block('includes/footer', $_);

?>