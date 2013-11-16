hacktx2013
==========

Project for HackTX 2013: Image finder for food menu. 

Directory structure
----

* _controllers: Settings and routing files 
 * _libs: includes general purpose libraries (functions, html, apis, etc) 
* _models: Object files that interact with database 
* _views: Contains the main body for html pages 
 * _imgs: images for pages 
 * _incs: included files for pages 
 * _scrs: javascript files for pages 
 * _stys: css styles for pages 

Other files 
---- 

### *.htaccess* code
.htaccess: matches url with regexes to figure out where the user is trying to go. This gets then filtered by _controllers/controller.php
```
RewriteRule ^([a-zA-Z0-9\-]+)$ index.php?view=$1&%{QUERY_STRING}
```

### *_controllers/controller.php* 
_controllers/controller.php: a basic switch-case statement that matches the pattern from a given url to a particular view i.e./ with a given url: http://mysite.com/login 
```
$view = $_GET['view']; 
switch($view) {
    case 'login':
        require_once("_views/view.Login.php"); 
        break; 
    default: break; 
}
``` 

### *_controllers/_libs/html.php* 
Includes 3 main functions for html documents: HTMLhead, HTMLnav, HTMLfoot. Since all html pages contain these properties, they are implicitly included before and after the view files. 
```
function HTMLhead($page) {
	?>
<!DOCTYPE html>
<html><head>
 <title></title>
 	...
 </head><body>
 	<?
}

function HTMLnav($page) {
	?>
<nav>
	...
</nav>
	<?
}

function HTMLfoot($page) {
	?>
</body></html>
	<?
}
```

Other Comments
----

### *_views/index.php* 
Every directory has an index.php file that redirects the user to the directory one level up until the main directory to prevent the users from seeing the contents of the directories. 
```
<?php
header("Location ../"); 
?>
``` 