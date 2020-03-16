https://makitweb.com/confirmation-alert-before-delete-record-with-jquery-ajax/




# sql
https://makitweb.com/how-to-add-custom-filter-in-datatable-ajax-and-php/

http://www.ilovephp.net/php/how-to-import-excel-file-data-into-mysql-database-in-php/

RewriteEngine on  
  
RewriteRule ^ABOUT  about.php [NC,L]
RewriteRule ^CONTACT  contact.php [NC,L]
RewriteRule ^PRODUCT  product.php [NC,L] 


RewriteRule ^IMAGE/([a-zA-Z0-9\-=&_@\.\,\)\(]*)/([a-zA-Z0-9\-=&_@\.\,\)\(]*)/([a-zA-Z0-9\-=&_@\.\,\)\(]*)$ /image_folder/image.php?param1=$1&param2=$2&param3=$3 [NC,L]
RewriteRule ^IMAGE/([a-zA-Z0-9\-=&_@\.\,\)\(]*)/([a-zA-Z0-9\-=&_@\.\,\)\(]*)$ /image_folder/image.php?param1=$1&param2=$2 [NC,L]
RewriteRule ^IMAGE/([a-zA-Z0-9\-=&_@\.\,\)\(]*)$ /image_folder/image.php?param1=$1 [NC,L]
RewriteRule ^IMAGE image_folder/image.php [NC,L]




