# Microbe PHP framework  
  
<h4>Lightweight PHP framework for simple site construction</h4>  
<h3>Version 0.1.1 (development)</h3>  
  
&nbsp;&nbsp;&nbsp;Project: Microbe PHP Framework  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;About: Lightweight PHP framework for simple site construction  
&nbsp;&nbsp;&nbsp;Version: 0.1.1 (developement)  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Begin: 2017 may 01  
&nbsp;&nbsp;&nbsp;Current: 2019 march 17  
&nbsp;&nbsp;&nbsp;&nbsp;Author: Microbe PHP Framework author <microbe-framework@protonmail.com>  
Copyright: Microbe PHP Framework author <microbe-framework@protonmail.com>  
&nbsp;&nbsp;&nbsp;License: MIT license  
&nbsp;&nbsp;&nbsp;&nbsp;Source: https://github.com/microbe-framework/microbe/  
  
<h3>1. Short help:</h3>  
  
1.1. Unzip or git clone package in root directory of Your website.  
1.2. Correct '.htaccess' and 'index.php'.  
1.3. Edit routes in '/config/routes.json'.  
1.4. Add data models in '/application/model/' if needs.  
1.5. Add views' render routines in '/application/views/' if needs.  
1.6. Edit action handlers in '/application/controllers/' if needs.  
1.7. Edit loader for Your own classes in '/application/AppLoader.inc.php'.  
1.8. Place Your layouts, templates, blocks in corresponding 'views' directory.  
1.9. Enjoy.  
  
<h3>2. Default directories structure:</h3>  
  
/www-root/  
&nbsp;&nbsp;&nbsp;&nbsp;/README  
&nbsp;&nbsp;&nbsp;&nbsp;/README.md  
&nbsp;&nbsp;&nbsp;&nbsp;/LICENSE  
&nbsp;&nbsp;&nbsp;&nbsp;/.htaccess  
&nbsp;&nbsp;&nbsp;&nbsp;/index.php  
&nbsp;&nbsp;&nbsp;&nbsp;/sitemap.xml  
&nbsp;&nbsp;&nbsp;&nbsp;/robots.txt  
&nbsp;&nbsp;&nbsp;&nbsp;/config/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/config.txt  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/routes.json  
&nbsp;&nbsp;&nbsp;&nbsp;/application/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/AppLoader.inc.php  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/routers/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/AppRouter.class.php  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/models/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/AppModel.inc.php  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/views/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/AppView.class.php  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/controllers/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/AppController.class.php  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;/framework/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/library/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/classes/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;/views/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/layouts/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/templates/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/blocks/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;/vendor/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;/assets/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/css/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/microbe.css  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/js/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/microbe.js  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/images/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/icons/  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...  
  
<h3>3. Changes.</h3>  

<h4>Version 0.1.1</h4>  
<h4>Date 2019 march 16</h4>  
&nbsp;&nbsp;&nbsp;&nbsp;Enclose framework classes into namespace 'Microbe'  
&nbsp;&nbsp;&nbsp;&nbsp;Add database connection support (MySqli only).  
&nbsp;&nbsp;&nbsp;&nbsp;Add classes for recordsets & connections.  
&nbsp;&nbsp;&nbsp;&nbsp;Add Model class.  
&nbsp;&nbsp;&nbsp;&nbsp;Old loader '/application/load.inc.php' replaced with Loader and AppLoader classes.  
&nbsp;&nbsp;&nbsp;&nbsp;Add HttpRequest class.  
&nbsp;&nbsp;&nbsp;&nbsp;Detects and handle site prefix if site locates not in server root.  
&nbsp;&nbsp;&nbsp;&nbsp;Change directories structure.  
&nbsp;&nbsp;&nbsp;&nbsp;Add assets directory and place js, css and images into assets.  
&nbsp;&nbsp;&nbsp;&nbsp;Extends set of configuration variables for config.txt.  
  
<h4>Version 0.1.0</h4>  
<h4>Date 2018 february 23</h4>  
&nbsp;&nbsp;&nbsp;&nbsp;First release.  
  