## DevelopX-JA - installation guide

####Requirements:

- PHP >= 7.2.9 (XAMPP)
- BCMath PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension


- node v12.4.0
- npm 6.9.1-next.0
- composer
- mysql

####Installation: 

1. Install latest node.js
2. Install latest npm
3. Install composer
4. Install Xampp PHP 7.2+
5. Clone project from GitHub   
   ```
   https://github.com/jakub-adamski/developx-ja.git
   ```
6. Setup Virtual Host in Xampp:  
   Go to: ```C:\xampp\apache\conf\extra\httpd-vhosts.conf ```  
   And paste that code:
   ```
     <VirtualHost *:80>  
         DocumentRoot "C:\Users\Jakub\PhpstormProjects\developx-ja\public"  
         <Directory "C:\Users\Jakub\PhpstormProjects\developx-ja">  
             Options Indexes FollowSymLinks
             AllowOverride All
             Require all granted  
         </Directory>  
     </VirtualHost>
   ```
   Replace ```C:\Users\Jakub\PhpstormProjects\developx-ja``` with your custom path, start apache and mysql.
7. Copy ``` .env ``` file
8. Create database and setup connection details in ``` .env ``` file.
9. Run ``` composer install ```
10. Run ``` npm install ```
11. Run ``` php artisan key:generate ``` to regenerate secure key.
12. Run ``` php artisan passport:keys ``` to generate the encryption keys Passport needs in order to generate access token.
13. Run ``` php artisan migrate ``` to create data base tables.
14. Run ``` php artisan optimize ``` to optimize framework for better performance.

####Features:

After registration, you will be able to view the Vue component for generating notes.
There is also a component with the user withdraw history witch is created using Vuex.

####Tests:

To run tests, type ``` php artisan dusk ```

