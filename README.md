# CourseLMS

This repository was based on the laravel template bought on https://codecanyon.net/item/courselms-plus-learning-management-system/30585343

The licence is only for one domain, so it needs to manage like 

#### httpd-vhosts.conf
<VirtualHost *:80>
    ServerAdmin webmaster@dummy-host2.example.com <br/>
    DocumentRoot "C:/xampp/htdocs/CourseLMS" <br/>
    ServerName local.lms.olmaa.net <br/>
    ErrorLog "logs/course-lms.com-error.log" <br/>
    CustomLog "logs/course-lms.com-access.log" common <br/>
    <br/>
</VirtualHost>

#### C:\Windows\System32\drivers\etc\hosts
127.0.0.1 local.lms.olmaa.net


## Stage URL 
http://lms.olmaa.net/


## Test accounts
Admin email : admin@gmail.com
Instructor email : instructor@gmail.com
Student email : student@gmail.com
password for all : 12345678