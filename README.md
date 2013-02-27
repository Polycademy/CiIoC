CiIoC
========

This is simply a custom config file that uses the Pimple Dependency Injection library (https://github.com/fabpot/Pimple) so it can be seamlessly integrated into Codeigniter.

Install Pimple first via Composer.

```
"pimple/pimple": "*"
```

This will not work for your controllers or models. It's meant for any libraries you have that has a complex dependent object graph. So basically the ioc.php will be an autoloaded config file using CI's autoloader. Simply place this line of code into your ''application/config/autoload.php''

```php
$autoload['config'] = array('ioc');
```

Then place the ''ioc.php'' into ''application/config/ioc.php''. You will need to edit the ioc.php to setup all the nitty gritty details of your object dependencies. It's not a simple drop in and start using. Make sure to remove the examples.

This ioc config library requires you to have a PSR-0 autoloader that autoloads both your Composer libraries (to get Pimple) and your normal Libraries and Third_parties. You can do this via my CiAutoloading hook. Check https://github.com/Polycademy/CiAutoloading

Once you've setup some dependency injected classes in ''application/libraries'' and you've got them autoloaded with a PSR-0 autoloader with Pimple, and you autoloaded (using CI's Autoloader) the ioc.php as a config file, you'll be able to start using this in your controllers.

```php
    //imagine this was a method of any controller
    public function test_ioc(){
 
        //this line can actually be placed in either the constructor, or a custom MY_Controller so you don't have to keep referring to the $config value.
        $ioc = $this->config->item('ioc');
		
		//imagine we had a MasterLibrary...
        $masterlibrary = $ioc['MasterLibrary'];
 
		//imagine that MasterLibrary had a method that does something
        $masterlibrary->do_something();
		
    }
```