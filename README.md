# PlainFramework - A Plain PHP Framework

PlainFramework is a MVC web application framework with an elegant syntax to make the life of a PHP developer simple. PlainFramework has started as a very small "Framework", working with the template Engine Smarty. Now a days, PlainFramework is still using Smarty but has a lot more elegant syntax, and more functions.

## Features

- Language support
- Simple, fast routing
- Simple database class (using PDO)
- Template engine (Smarty) inbuilt
- Query builder

## Installation

PlainFramework is made to be simple, so you are able to download - upload this repository to your FTP or localhost server. After that you would need to change some settings in the config.php, you can find the config.php in the directory "app".

PlainFramework is made up out of 2 directories, the "app" folder, your application and the "framework" folder, you can find all the PlainFramework files, cache files, and libraries in here.

## MVC Explanation

- **(M) Models** : Models are for your database interaction, models are also used for other types of data interaction think of XML / JSON responses from external sources etc.
- **(V) Views** : Views are your actual pages, they are build with the variables you got from your controllers, whitch the controllers got from the models most of the times. The views are most of the time the only files that contain HTML.
- **(C) Controllers** : Controllers are for building your information (from the models) into nice variables that you can send later on your view.