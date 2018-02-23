<div class="microbe-article">
  <h2>Article #3</h2>
  <p><a href="<?=$this->getUrl('./articles');?>">Back to articles</a></p>
  <p>
<?php
  echo 'Local variables $_:';
  foreach ($_ as $key => $value) {
    echo '<br>';
    echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$key.' = '.$value;
  }
  echo '<br>';  
?>
  </p>
  <p><a href="<?=$this->getUrl('./articles');?>">Back to articles</a></p>
</div>