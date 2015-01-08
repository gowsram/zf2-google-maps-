[![Total Downloads](https://poser.pugx.org/gowsram/g-maps/downloads.png)](https://packagist.org/packages/gowsram/g-maps)
zf2-google-maps-
================

#### Google maps - ZF2  Module 

A zend framework 2 module for generate google maps using gmaps api.

Installation
------------

### Main Setup

#### By cloning project

1. This module is available on [Packagist](https://github.com/gowsram/zf2-google-maps-).
In your project's `composer.json` use:

	```json
    {   
        "require": {
			"php": ">=5.3.3",
			"zendframework/zendframework": "*",
			"gowsram/g-maps": "dev-master"
    }
	```
2. Or clone this project into your `./vendor/` directory.

Usage:

1. Edited your `application.config.php` file so that the `modules` array contains `GMaps`

	```php
	<?php
	return array(
		
    		'modules' => array(
        		'Application',
        		//...
        		'GMaps',
    		),
    		//...
	);
	```

2. Add the Google Maps API key in either:
	* your module's `config/module.config.php`
	* the application `config/autoload/global.php`
	* the application `config/autoload/local.php` (recommended to avoid publishing your API key)

	```php
	<?php
	return array(
		'GMaps'=> array(
			'api_key' => 'Your Google Maps API Key',
		),
		//...
	);
    ```
    
2. In the controller 

	```php
	$markers = array(
            'Mozzat Web Team' => '17.516684,79.961589',
            'Home Town' => '16.916684,80.683594'
        );  //markers location with latitude and longitude

        $config = array(
            'sensor' => 'true',         //true or false
            'div_id' => 'map',          //div id of the google map
            'div_class' => 'grid_6',    //div class of the google map
            'zoom' => 5,                //zoom level
            'width' => "600px",         //width of the div
            'height' => "300px",        //height of the div
            'lat' => 16.916684,         //lattitude
            'lon' => 80.683594,         //longitude 
            'animation' => 'none',      //animation of the marker
            'markers' => $markers       //loading the array of markers
        );

        $map = $this->getServiceLocator()->get('GMaps\Service\GoogleMap'); //getting the google map object using service manager
        $map->initialize($config);                                         //loading the config   
        $html = $map->generate();                                          //genrating the html map content  
        return new ViewModel(array('map_html' => $html));                  //passing it to the view
    ```

3. In the View 

	```php
	<?php echo $this->map_html; ?>
	```
	
