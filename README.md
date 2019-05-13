# Microbe PHP framework  
  
<h4>Lightweight PHP framework for simple site construction</h4>  
<h3>Version 0.1.3 (development)</h3>  
  
&nbsp;&nbsp;&nbsp;Project: Microbe PHP Framework  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;About: Lightweight PHP framework for simple site construction  
&nbsp;&nbsp;&nbsp;Version: 0.1.3 (developement)  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Begin: 2017 may 01  
&nbsp;&nbsp;&nbsp;Current: 2019 may 13  
&nbsp;&nbsp;&nbsp;&nbsp;Author: Microbe PHP Framework author <microbe-framework@protonmail.com>  
Copyright: Microbe PHP Framework author <microbe-framework@protonmail.com>  
&nbsp;&nbsp;&nbsp;License: MIT license  
&nbsp;&nbsp;&nbsp;&nbsp;Source: https://github.com/microbe-framework/microbe/  
  
One of the goals of this project is Router-View architecture.  
The application render a layout directly after routing.  
You must define routing rules and create corresponding views.  
Controllers unnecessary at all.  
This approach applicable for simple sites and landing pages.  
  
Project under developement.  
Please report about bugs.  
  
<h3>1. Short help:</h3>  
  
1.1.  Unzip or git clone package in root application directory.  
1.2.  Site documents' root must be './application/web/' directory.  
1.3.  Enable mod_rewrite for './application/web/' directory.  
1.4.  Correct './application/web/.htaccess' and './application/web/index.php' (optional).  
1.5.  Edit config in './application/configs/config.txt'.  
1.6.  Edit routes in './application/configs/routes.json'.  
1.7.  Edit variables in './application/configs/vars.json' (optional).  
1.8.  Add data models in './application/Models/' (optional).  
1.9.  Add controllers and edit action handlers in './application/Controllers/' (optional).  
1.10.  Add classes to './application/Classes/' (optional).  
1.11. Place Your layouts, templates, blocks in './application/views/' directory.  
1.12. Enjoy.   
  
/root/  
&nbsp;&nbsp;&nbsp;&nbsp;/README  
&nbsp;&nbsp;&nbsp;&nbsp;/README.md  
&nbsp;&nbsp;&nbsp;&nbsp;/LICENSE  
&nbsp;&nbsp;&nbsp;&nbsp;/application/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/configs/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/config.txt  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/vars.json  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/routes.json  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/Classes  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/AppRouter.php  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/AppView.php  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/Controllers  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/AppController.php  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/Models  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/AppModel.php  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/views/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/queries/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/web/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/.htaccess  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/index.php  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/vendor/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/assets/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/css/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/microbe.css  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/js/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/microbe.js  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/images/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/icons/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/fonts/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;/framework/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/library/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/classes/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/Loader.php  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
    
<h3>3. Changes.</h3>  
  
<h4>Version 0.1.3 (2019 may 13)</h4>  
1. Add administrator's web interface<br/>
2. Add to class Microbe\Library\Http response methods<br/>
3. Make Registry class static<br/>
4. Change directories structure.<br/>
5. Change './web/assets/css/microbe.css'.<br/>
6. Change './web/assets/js/microbe.js'.<br/>
  
<h4>Version 0.1.2 (2019 april 08)</h4>  
1. Add PostgreSql database support (not tested).<br/>
2. Remake render engine.<br/>
3. Add Log and Timer classes.<br/>
4. Rename class files from 'ClassName.class.php' to 'ClassName.php'<br/>
5. Change namespaces.<br/>
6. Change classloader to namespace-based.<br/>
7. Change directories structure.<br/>
8. Allow web access only to './web/' directory.<br/>
9. Change './web/assets/css/microbe.css'.<br/>
  
<h4>Version 0.1.1 (2019 march 17)</h4>  
1. Enclose framework classes into namespace 'Microbe'.<br/>
2. Add database connection support (MySqli only).<br/>
3. Add classes for recordsets & connections.<br/>
4. Add Model class.<br/>
5. Old loader '/application/load.inc.php' replaced with Loader and AppLoader classes.<br/>
6. Add HttpRequest class.<br/>
7. Detects and handle site prefix if site locates not in server root.<br/>
8. Change directories structure.<br/>
9. Add assets directory and place js, css and images into assets.<br/>
10. Extends set of configuration variables for config.txt.<br/>
  
<h4>Version 0.1.0 (2018 february 23)</h4>  
First release.  
  