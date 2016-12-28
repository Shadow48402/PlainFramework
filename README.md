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

## Controller Example

Controllers are very important for you application, since they are controlling what to load and what to show. Every controller does contain a default "Loader" object (`$this->load`), this object is made for loading in models and language files.

```php
<?php
class ControllerHome extends Controller {
    
    public function home()
    {   
        // Loading model "blog"
        $this->load->model('blog');
        // Executing model function
        $blog_items = $this->load->model_blog->getItems();

        $view = new View('home');
        
        // Loading Language file "default/header"
        $this->load->language('default/header', $view);
        
        // Assigning value in the view
        $view->set('blog_items', $blog_items);
        $view->display();
    }
    
}
```

## Model Example

The models do only contain 2 variables (`$this->db` / `$this->db_prefix`), the `$this->db` variable returns a custom DatabaseObject class, this class works with the PDO class of PHP, you can [look here](https://github.com/Shadow48402/PlainFramework/blob/master/framework/bin/class.database.php) for all the functions this class contains.

```php
<?php
class ModelBlog extends Model {
    
    public function getItems()
    {
        $query = $this->db->preparedStatement('SELECT * FROM ' . $this->db_prefix . 'blog_item WHERE public=:public', [':public' => 1]);
        return $query;
    }
    
}
```

## Using Language variables in view files

Let's say for example that you have a language file like the default "default/header.php":
```php
<?php

return [
    'home'  => 'Thuis'
];
```

You are able to use the 'home' variable in a view file like this, if you loaded the language file in your controller:
```php
{$lang_home}
```

By changing the SESSION variable `$_SESSION['language_code']` you are able to change the user his language.

## XSS and SQL protection

PlainFramework does contain different tools to protect XSS injection as well as SQL injection, the `$view->set($key, $value)` function does contain another parameter `$view->set($key, $value, $encoding)`, the encoding parameter is a boolean en escapes HTML characters when set to true (default true).

Since PDO has the function to use named parameters in prepared statements it's not required to prevent anything more than this.