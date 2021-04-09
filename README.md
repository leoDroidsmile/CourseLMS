
# CourseLMS

This repository was based on the laravel template bought on https://codecanyon.net/item/courselms-plus-learning-management-system/30585343

The licence is only for one domain, so it needs to manage to host on local as following

- httpd-vhosts.conf
```xml
<VirtualHost  *:80>
ServerAdmin webmaster@dummy-host2.example.com
DocumentRoot "C:/xampp/htdocs/CourseLMS"
ServerName local.lms.olmaa.net
ErrorLog "logs/course-lms.com-error.log"
CustomLog "logs/course-lms.com-access.log" common
</VirtualHost>
```
  

- C:\Windows\System32\drivers\etc\hosts

127.0.0.1 local.lms.olmaa.net

## Local Server
http://localhost
  

## Stage Server

http://lms.olmaa.net/

  
  

## Test accounts

Admin email : admin@gmail.com

Instructor email : instructor@gmail.com

Student email : student@gmail.com

password for all : 12345678