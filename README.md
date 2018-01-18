# Flexy
This is a small project build for Flexy.
Please don't pay attention on the products photos, I do this work at the end of the night and it's the only JPG that I found.

Let's begin:

### Database setup

Just go in the main folder and run the "initDatabase.sql" on your MySQL server.
Now go in 'config' folder and open the db.php and put your server information
```
'dsn' => 'mysql:host=localhost;dbname=flexy',
'username' => 'root',
'password' => '',
```

### Server configurations

If you don't want to do any configuration just run this code (on main folder) and access through localhost:8080. You can use the --port parameter to change the port.
```
php yii serve
```

Or you can put the entire project in your server and access with this link
```
http://localhost/flexy/web/index.php
```

Or you can do a configuration on Apache or Nginx.

* Recommended Apache Configuration
Use the following configuration in Apache's httpd.conf file or within a virtual host configuration. Note that you should replace path/to/flexy/web with the actual path for flexy/web.

```
# Set document root to be "flexy/web"
DocumentRoot "path/to/flexy/web"

<Directory "path/to/flexy/web">
    # use mod_rewrite for pretty URL support
    RewriteEngine on
    # If a directory or a file exists, use the request directly
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    # Otherwise forward the request to index.php
    RewriteRule . index.php

    # if $showScriptName is false in UrlManager, do not allow accessing URLs with script name
    RewriteRule ^index.php/ - [L,R=404]

    # ...other settings...
</Directory>
```

* Recommended Nginx Configuration
To use Nginx, you should install PHP as an FPM SAPI. You may use the following Nginx configuration, replacing path/to/flexy/web with the actual path for flexy/web and mysite.test with the actual hostname to serve.

```
server {
    charset utf-8;
    client_max_body_size 128M;

    listen 80; ## listen for ipv4
    #listen [::]:80 default_server ipv6only=on; ## listen for ipv6

    server_name mysite.test;
    root        /path/to/flexy/web;
    index       index.php;

    access_log  /path/to/flexy/log/access.log;
    error_log   /path/to/flexy/log/error.log;

    location / {
        # Redirect everything that isn't a real file to index.php
        try_files $uri $uri/ /index.php$is_args$args;
    }

    # uncomment to avoid processing of calls to non-existing static files by Yii
    #location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
    #    try_files $uri =404;
    #}
    #error_page 404 /404.html;

    # deny accessing php files for the /assets directory
    location ~ ^/assets/.*\.php$ {
        deny all;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_pass 127.0.0.1:9000;
        #fastcgi_pass unix:/var/run/php5-fpm.sock;
        try_files $uri =404;
    }

    location ~* /\. {
        deny all;
    }
}
```

#### If you have any question, please don't hesitate to contact me.
##### My email is surfjzo@gmail.com