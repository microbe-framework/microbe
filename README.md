# 0.1
  
Microbe PHP framework, release 0.1  
Lightweight PHP framework for simple site construction  
Test version  
Please report about bugs  
  
1. Short help  
  
1.1. Unzip package in root directory of your website  
1.2. Correct '.htaccess' and 'index.php'  
1.3. Edit routes in '/config/routes.json'  
1.4. Edit loaded php classes and stuff in '/application/loader.inc.php'  
1.5. Edit action handlers in '/application/AppController.class.php'  
1.6. Add Your routines to '/application/AppView.class.php' if needs  
1.7. Place Your layouts, templates, blocks in corresponding 'views' directory  
1.8. Enjoy  
  
2. Default directories structure:  
  
+/www-root/  
-/.htaccess  
-/index.php  
-/config/  
--/default.txt  
--/routes.json  
    /application/  
        /AppRouter.class.php  
        /AppController.class.php  
        /AppView.class.php  
        /loader.inc.php  
    /framework/  
        /library/  
            ...  
        /classes/  
            ...  
    /views/  
        /layouts/  
            ...  
        /templates/  
            ...  
        /blocks/  
            ...  
    /vendor/  
        ...  
    /css/  
        /microbe.css  
    /js/  
        /microbe.js  
    /images/  
        ...  
  
