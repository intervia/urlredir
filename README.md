# Redirect old URLs
Redirect old URLs to new ones using an array.   
Very fast, about 40K address in 3ms (view redir_test.php file for a working 
example).   
   
You can load redirections also from an external json or serialized array.   
On very large arrays using a json file may be a more convenient way to do it.
   
# Basic instructions   
1.- Redirect 404 errors from .htaccess:   
ErrorDocument 404 /error.php   
   
Note: if you are using a CMS that redirects all traffic to the index file such 
as Wordpress or Magento, you must include the code at the beginning of index.php
instead of redirecting errors and creating an error file.   
   
2.- Create an error.php file or insert this code at the start of index.php:   
   
    - An array to redirect old pages to new ones:   
    $redir['oldpage1'] = 'https://www.example.com/newpage1';   
    $redir['oldpage2'] = '/newpage2';   
    
    Alternatively, you can use a external JSON file, something like:
    $redir = json_decode(file_get_contents("redirections.json"),true);

    - Init class:   
    include "class_urlredir.php";   
    $urlredir = new urlredir;   

    - Redir old pages to new ones (by default with 301 code):   
    $urlredir->redirect($redir);   

    Alternatively you can use other redirect codes:   
    $code = '302';   
    $urlredir->redirect($redir,$code);   

    Accepted codes:   
    - 301 (default)   
    - 302 (Found)   
    - 303 (See Other)   
    - 307 (Temporary Redirect)   
    - 308 (Permanent Redirect) 