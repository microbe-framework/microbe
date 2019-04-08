
<!-- Content { -->

      <h3>Views</h3>
	  <p>
        Views are HTML rendered templates.
        Views locates in directory 
        <span class="app-span-highlight">'./application/views/'</span>.
        One template can include many others.
        Main template called a 
        <span class="app-span-highlight">layout</span>.
        Layout files have names like
        <span class="app-span-highlight">'viewname.layout.php'</span>.
        Other views have names like
        <span class="app-span-highlight">'viewname.inc.php'</span>.
	  </p>
	  <p>
	    Framework call view renderer from controller's action method:
	  </p>
	  <p class="app-path">
	    ./application/Controllers/AppController
      </p>
<pre class="app-pre">
namespace App\Controllers;

class AppController extends \Microbe\Core\Controller
{
    ...
    public function mainAction($page, $title)
    {
        return $this->view->renderLayout(
            'main',
            ['page' => $page, 'title' => $title]
        );
    }
    ...
}
  </pre>
      <p>
	    Also You can render a views directly.
	    You must define layout to process in routing rule.
	  </p>
	  <p class="app-path">
	    ./application/configs/routes.json
	  </p>
<pre class="app-pre">
routes: [
    ...
    {
        "regex": "#^/user$#",
        "layout": "main",
        "params": {"page": "user", "title:" "The user page"}
    },
    ...
]
</pre>
	  <p>
	    All views are ordinary php-processed files.
	    You have access by name to all routing rule parameters
	    defined in block <span class="app-span-highlight">'parameters'</span>.
	    In the view's code You can obtain access to 
	    <span class="app-span-highlight">View</span>
	    object with help 
	    <span class="app-span-highlight">$this</span> variable.
	  </p>
	  <table class="app-table-parameters">
	    <colgroup>
	      <col style="width: 30%">
	      <col style="width: 70">
	    </colgroup>
	    <caption>
	      Used in views 'shortcut' variables
	    </caption>
	    <thead>
	      <tr>
	        <td>Variable</td>
	        <td>Description</td>
	      </tr> 
	    </thead>
	    <tbody>
	      <tr>
	        <td class="app-table-cell-method">$this</td>
	        <td class="app-table-cell-description">accessor to <span class="app-span-highlight">View</span>
	          object methods and properties
	        </td>
	      </tr>
	      <tr>
	        <td class="app-table-cell-method">$me</span></td>
	        <td class="app-table-cell-description">same with <span class="app-span-highlight">$this</span></td>
	      </tr>
	      <tr>
	        <td class="app-table-cell-method">$app</td>
	        <td class="app-table-cell-description">main application object instance</td>
	      </tr>
	    </tbody>
	  </table>
	  <p>
	    Class <span class="app-span-highlight">View</span>
	    have many methods for access to framework's objects, methods and properties.
	  </p>
	  <table class="app-table-parameters">
	    <colgroup>
	      <col style="width: 30%">
	      <col style="width: 70">
	    </colgroup>
	    <caption>
	      View object main methods
	    </caption>
	    <thead>
	      <tr>
	        <td>Method</td>
	        <td>Description</td>
	      </tr> 
	    </thead>
	    <tbody>
	      <tr>
	        <td class="app-table-cell-method">getConfigValue($name)</td>
	        <td class="app-table-cell-description">get value of configuration parameter
	          <span class="app-span-highlight">$name</span>.
	        </td>
	      </tr>
	      <tr>
	        <td class="app-table-cell-method">getVar($name)</td>
	        <td class="app-table-cell-description">get value of application variable 
	          <span class="app-span-highlight">$name</span>
	        </td>
	      </tr>
	      <tr>
	        <td class="app-table-cell-method">setVar($name, $value)</td>
	        <td class="app-table-cell-description">set value of application variable 
	        <span class="app-span-highlight">$name</span>
	      </td>
	      </tr>
	      <tr>
	        <td class="app-table-cell-method">block($path)</td>
	        <td class="app-table-cell-description">include and process file
	          by relative path to view in directory
	          <span class="app-span-highlight">'./application/views/'</span>
	          ($path).
	        </td>
	      </tr>
	    </tbody>
	  </table>

	  <p></p>

      <div class="row app-handbook-nav">
        <div class="microbe-col-4-fix microbe-left">
          <a href="<?=$this->getUrl('./handbook/models');?>">&lt;&lt; Models</a>
        </div>
        <div class="microbe-col-4-fix microbe-center">
          <a href="<?=$this->getUrl('./handbook');?>">Handbook</a>
        </div>
        <div class="microbe-col-4-fix microbe-right">
          <a href="<?=$this->getUrl('./handbook/classes');?>">Classes &gt;&gt;</a>
        </div>
      </div>
  
<!-- } Content -->
