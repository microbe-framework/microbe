
<!-- Configuration block -->

      <h3>Handbook</h3>
      <p>
      </p>

      <h4>Configuration</h4>
      <p>
        After the start an application reads a configuration file.
        By default the configuration file has a name
        <span class="app-span-highlight">'./application/configs/config.txt'.</span>
      </p>
      <p>    
        The configuration file consists of lines of parameters and C-style comments.
        The parameters are pairs of names and values delimited by signs of equality ('=').
      </p>
      <p class="app-read-more">
        <a href="<?=$this->getUrl('./handbook/configuration');?>">Read more...</a>
      </p>

<!-- Routing block -->
  
      <h4>Routing</h4>
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
      <p>
        <span class="app-span-highlight">Action</span> parameters
        are applied if request complies with the rule's
        <span class="app-span-highlight">filtration</span> parameters.
        The <span class="app-span-highlight">Action</span> parameters define a request handling method.
      </p>
      <p class="app-read-more">
        <a href="<?=$this->getUrl('./handbook/routing');?>">Read more...</a>
      </p>

<!-- Controllers block -->
  
      <h4>Controllers</h4>
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
      <p class="app-read-more">
        <a href="<?=$this->getUrl('./handbook/controllers');?>">Read more...</a>
      </p>

<!-- Models -->

      <h4>Models</h4>
      <p>
        The models are used for access to data sources.
        Models extends framework's php object
        <span class="app-span-highlight">Model</span>
        and have access to all base class properties and methods.
        You can create a model class and place it in
        <span class="app-span-highlight">'./application/Models/'</span> directory.
      </p>
      <p>
        Data source access parameters locates in
        <span class="app-span-highlight">'database'</span> section
        of configuration file.
        All parameters are self-explanatory.
      </p>
      <p class="app-path">
        ./application/configs/config.txt
      </p>
<pre class="app-pre">
...
database.enable = 1
database.driver = mysqli
database.host = localhost
database.port = 3306
database.user = user
database.pass = pass
database.base = test
...
</pre>
      <p class="app-read-more">
        <a href="<?=$this->getUrl('./handbook/models');?>">Read more...</a>
      </p>

<!-- Views -->

      <h4>Views</h4>
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
        Framework call view renderer from controller's action method.
      </p>
      <p class="app-read-more">
        <a href="<?=$this->getUrl('./handbook/views');?>">Read more...</a>
      </p>
  
<!-- Classes block -->

      <h4>Add classes to application</h4>
      <p>
        The application classes must belongs to namespace
        <span class="app-span-highlight">App\Classes</span>.
        Name of file with class must be same with class name:
      </p>
      <p>
        You can use classes in code of views.
      </p>
      <p class="app-read-more-last">
        <a href="<?=$this->getUrl('./handbook/classes');?>">Read more...</a>
      </p>

<!-- } Content -->
