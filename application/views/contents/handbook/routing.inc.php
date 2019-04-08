
<!-- Content { -->

      <h3>Routing</h3>
      <p>
        At first the application dispatch HTTP request with help of
        <span class="app-span-highlight">routes</span>.
        By default routes stored in the file
        <span class="app-span-highlight">'./application/configs/routes.json'</span>.
      </p>
      <p>
        Routes are JSON-array of rules beginning after declaration
      </p>
<pre class="app-pre">
"routes": [
</pre>
      <p>
        Every rule is JSON-array of name-value parameters.
      </p>
      <p>
        <span class="app-span-highlight">Filtration</span> parameters
        using for check a HTTP request by their conditions.
      </p>

      <table class="app-table-parameters">
        <colgroup>
          <col style="width: 20%">
          <col style="width: 80%">
        </colgroup>
        <caption>
          Filtration parameters
        </caption>
        <thead>
          <tr>
            <td>Name</td>
            <td>Description</td>
          </tr> 
        </thead>
        <tbody>
          <tr>
            <td class="app-table-cell-name">match</td>
            <td class="app-table-cell-description">URI must be same with 'match' value</td>
          </tr>
          <tr>
            <td class="app-table-cell-name">regex</td>
            <td class="app-table-cell-description">URI must match php regular expression</td>
          </tr>
          <tr>
            <td class="app-table-cell-name">allow</td>
            <td class="app-table-cell-description">JSON-array of allowed HTTP request methods: GET, POST, etc</td>
          </tr>
        </tbody>
      </table>

      <p>
        <span class="app-span-highlight">Action</span> parameters
        are applied if request complies with the rule's
        <span class="app-span-highlight">filtration</span> parameters.
        The <span class="app-span-highlight">Action</span> parameters define a request handling method.
      </p>

      <table class="app-table-parameters">
        <colgroup>
          <col style="width: 20%">
          <col style="width: 80">
        </colgroup>
        <caption>
          Action parameters
        </caption>
        <thead>
          <tr>
            <td>Name</td>
            <td>Description</td>
          </tr> 
        </thead>
        <tbody>
          <tr>
            <td class="app-table-cell-name">controller</td>
            <td class="app-table-cell-description">define controller (work with action together)</td>
          </tr>
          <tr>
            <td class="app-table-cell-name">action</td>
            <td class="app-table-cell-description">define action (work with controller together)</td>
          </tr>
          <tr>
            <td class="app-table-cell-name">layout</td>
            <td class="app-table-cell-description">render a layout directly (don't use a controller)</td>
          </tr>
          <tr>
            <td class="app-table-cell-name">template</td>
            <td class="app-table-cell-description">render a template directly (don't use a controller)</td>
          </tr>
          <tr>
            <td class="app-table-cell-name">code</td>
            <td class="app-table-cell-description">specify a HTTP response code</td>
          </tr>
          <tr>
            <td class="app-table-cell-name">exit</td>
            <td class="app-table-cell-description">immediatelly exit and send empty response</td>
          </tr>
        </tbody>
      </table>
      <p>Sample routing rule:</p>
<pre class="app-pre">
...
{
    "match": "/index",
    "controller": "app",
    "action": "page",
    "params": {"page": "index", "title:" "The index page"}
},
...
</pre>
      <p>
        This rule catch requests with URI <span class="app-span-highlight">'/index'</span>
        (for example: <span class="app-span-highlight">http://127.0.0.1/index</span>).
      </p>
      <p>
        The request catched by rule will be handled with action method
        <span class="app-span-highlight">pageAction</span>
        of
        <span class="app-span-highlight">AppController</span>.
      </p>
      <p>
        <span class="app-span-highlight">AppController</span>
        class must be located in file with name
        <span class="app-span-highlight">'\App\Controllers\AppController'</span>.
      </p>
      <p>
        Controller class name calculates by php code:
      </p>
<pre class="app-pre">
'\App\Controllers\' . ucfirst($controller) . 'Controller'
</pre>
      <p>
        where (for this case) <span class="app-span-highlight">$controller = 'app'</span>
      </p>
      <p>        
        The controller's class action method
        <span class="app-span-highlight">pageAction</span>
        for our sample
        must have <span class="app-span-highlight">public</span> access
        and must accept 2 parameters:
        <span class="app-span-highlight">$page</span> and
        <span class="app-span-highlight">$title</span>.
      </p>
      <p>
        Sample of controller with action method for this routing rule:
      </p>
      <p class="app-path">
        ./application/Controllers/AppController.php
      </p>
<pre class="app-pre">
namespace App\Controllers;

class AppController extends \Microbe\Core\Controller
{
    ...
    public function pageAction($page, $title)
    {
        return $this->view->renderLayout(
            'main',
            ['page' => $page, 'title' => $title]
        );
    }
    ...
}
</pre>

      <div class="row app-handbook-nav">
        <div class="microbe-col-4-fix microbe-left">
          <a href="<?=$this->getUrl('./handbook/configuration');?>">&lt;&lt; Configuration</a>
        </div>
        <div class="microbe-col-4-fix microbe-center">
          <a href="<?=$this->getUrl('./handbook');?>">Handbook</a>
        </div>
        <div class="microbe-col-4-fix microbe-right">
          <a href="<?=$this->getUrl('./handbook/controllers');?>">Controllers &gt;&gt;</a>
        </div>
      </div>

<!-- } Content -->
