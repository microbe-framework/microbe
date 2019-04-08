
<!-- Content { -->

	  <h3>How to add classes to application?</h3>
	  <p>
	    The application classes must belongs to namespace
	    <span class="app-span-highlight">App\Classes</span>.
	    Name of file with class must be same with class name:
	  </p>
	  <p class="app-path">
	    ./application/Classes/AppHtml.php
	  </p>
<pre class="app-pre">
namespace App\Classes;

class AppHtml
{
    ...
    public function getTitle($title)
    {
        return '&lt;title&gt;' . $title . '&lt;/title&gt;';
    }
    ...
}
</pre>
      <p>
	    You can use classes in code of views.
      </p>
      <p>
	    Don't forget to apply namespace prefix
	    <span class="app-span-highlight">\App\Classes\</span>
	    .
      </p>
      <p class="app-path">
        ./application/views/some.layout.php
      </p>
<pre class="app-pre">
...
&lt;?php
$appHtml = new \App\Classes\AppHtml();
echo $appHtml->getTitle('My page title');
?&gt;
...
</pre>

      <div class="row app-handbook-nav">
        <div class="microbe-col-4-fix microbe-left">
          <a href="<?=$this->getUrl('./handbook/views');?>">&lt;&lt; Views</a>
        </div>
        <div class="microbe-col-4-fix microbe-center">
          <a href="<?=$this->getUrl('./handbook');?>">Handbook</a>
        </div>
        <div class="microbe-col-4-fix microbe-right">
          <!--<a href="<?=$this->getUrl('./handbook');?>">Handbook &gt;&gt;</a>-->
        </div>
      </div>
  
<!-- } Content -->
