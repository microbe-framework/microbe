
<!-- Content { -->

      <h3>Controllers</h3>
      <p>
        Controllers are dispatch incoming requests and render views.
      </p>
      <p>
        Controllers locates in directory
        <span class="app-span-highlight">'./application/Controllers/'</span>.
      </p>
      <p>
        Controller file name must be same with controller's class.
      </p>
      <p>
        For class
        <span class="app-span-highlight">AppController</span>,
        controler's class file path and name must be
        <br>
        <span class="app-span-highlight">'./application/Controllers/AppController.php'</span>.
      </p>
      <p>
        Framework's engine call a controller action
        if selected routing rule has both of parameters
        <span class="app-span-highlight">'controller'</span>
        and
        <span class="app-span-highlight">'action'.</span>
      </p>
      <h4>Creation a sample controller:</h4>
      <p>
        For example, let the controller class name will be
        <span class="app-span-highlight">UserController</span>.
      </p>
      <p>
        At first create a file
        <span class="app-span-highlight">'./application/Controllers/UserController.php'</span>.
      </p>
      <p>
        All application controllers
        must belongs to namespace
        <span class="app-span-highlight">App\Controllers</span>.
        Class
        <span class="app-span-highlight">UserController</span>
        must be public and extends a framework controller's base class
        <span class="app-span-highlight">\Microbe\Core\Controller</span>;
      </p>
      <p>
        Then create handling method
        for routing rules parameter
        'action' = 'main'
        named
        <span class="app-span-highlight">mainAction</span>
        with method parameters
        <span class="app-span-highlight">page</span>
        and
        <span class="app-span-highlight">title</span>.
      </p>
      <p>
        Sample rule for our controller:
      </p>
      <p class="app-path">
        ./application/configs/routes.json
      </p>
<pre class="app-pre">
...
{
     "regex": "#^/user$#",
     "controller": "user",
     "action": "main",
     "params": {"page": "user", "title:" "The user page"}
},
...
</pre>
      <p>
        This rule catch requests with URI <span class="app-span-highlight">/user</span>,
        for example - <span class="app-span-highlight">http://127.0.0.1/user</span>.
      </p>
	  <p>
	    Rule handled by action method
	    <span class="app-span-highlight">mainAction</span>
	    of controller
	    <span class="app-span-highlight">\App\Controllers\UserController</span>.
	  </p>
	  <p>
	    Action method must accept 2 parameters:
	    <span class="app-span-highlight">$page</span>
	    and
	    <span class="app-span-highlight">$title</span>.
	  </p>
	  <p class="app-path">
	    ./application/Controllers/UserController.php
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

      <div class="row app-handbook-nav">
        <div class="microbe-col-4-fix microbe-left">
          <a href="<?=$this->getUrl('./handbook/routing');?>">&lt;&lt; Routing</a>
        </div>
        <div class="microbe-col-4-fix microbe-center">
          <a href="<?=$this->getUrl('./handbook');?>">Handbook</a>
        </div>
        <div class="microbe-col-4-fix microbe-right">
          <a href="<?=$this->getUrl('./handbook/models');?>">Models &gt;&gt;</a>
        </div>
      </div>
  
<!-- } Content -->
