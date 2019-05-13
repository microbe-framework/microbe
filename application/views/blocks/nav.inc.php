<div class="app-nav">
  <a href="<?=$this->getUrl()?>">About</a>
  <div class="app-nav-dropdown">
    <a href="<?=$this->getUrl('./handbook')?>">Handbook</a>
    <ul>
      <li><a href="<?=$this->getUrl('./handbook/configuration')?>">Configuration</a></li>
      <li><a href="<?=$this->getUrl('./handbook/routing')?>">Routing</a></li>
      <li><a href="<?=$this->getUrl('./handbook/controllers')?>">Controllers</a></li>
      <li><a href="<?=$this->getUrl('./handbook/models')?>">Models</a></li>
      <li><a href="<?=$this->getUrl('./handbook/views')?>">Views</a></li>
      <li><a href="<?=$this->getUrl('./handbook/classes')?>">Classes</a></li>
    </ul>
  </div>
  <a href="<?=$this->getUrl('./changes')?>">Changes</a>
  <a href="<?=$this->getUrl('./license')?>">License</a>
</div>
<div class="app-nav-spacer">
</div>
