# Simple LAMP Logs Collector

This is a simple logs collector for the dev environment

For example, we have a website (https://localhost/index.php)
```
/var/www/html/index.php
```
and we want to see logs in a new bookmark (https://localhost/logs.php)

How to set up it? First of all, need config NGINX (version for apache will be a letter) 

NGINX config file: 
```
location ~ /logs.php {
    include         fastcgi_params;
    root            /var/www/html/;
    fastcgi_pass    unix:/var/run/php/php7.2-fpm.sock;
    fastcgi_param   SCRIPT_FILENAME  /var/www/html/logs.php;
}
```
then put logs.php into 
```
/var/www/html
```
# pasword protection

If you want password protection you need to create .htpasswd. Run the command below as root, don't forget to change the username to your user which will use in the login form:

```
# sh -c "echo -n 'username:' >> /etc/nginx/.htpasswd"
```
Then set password for user:
```
# sh -c "openssl passwd -apr1 >> /etc/nginx/.htpasswd"
```
This command can check result
```
cat /etc/nginx/.htpasswd
```
And last, add derective to you nginx site config file

```
location ~ /logs.php {
    .....
    .....
    auth_basic "Very security content";
    auth_basic_user_file /etc/nginx/.htpasswd;
}
```
