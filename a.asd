<IfModule mod_rewrite.c>
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ index.php/$1 [QSA,PT,L]
</IfModule>
<FilesMatch ".(flv|gif|jpg|jpeg|png|ico|swf|js|css|woff2)$">
Header set Cache-Control "max-age=2592000"
</FilesMatch>
