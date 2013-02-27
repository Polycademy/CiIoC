<?php

/**
 * Pimple uses anonymous functions (lambdas) so it can "lazy load" the classes
 * the functions will not be processed when the PHP interpreter goes through this file
 * they will be kept inside the function waiting to be called as part of the container array
 * once you call the functions, then the objects will be created! Thus "lazy loading", not "eager loading". Saves memory too!
 * note Pimple is an object that acts like an array, see the actual Pimple code to see how this works
 */

$ioc = new Pimple;

/**
 * EXAMPLES BEGIN HERE, REMOVE THIS TO SETUP YOUR OWN DEPENDENCIES
 */

//this creates the Worker Library, not necessary since the WorkerLibrary has no dependencies, but demonstrates self-reference of $c
//when Pimple runs your anonymous function, it will pass in the Pimple object into $c making it self-referential, kind of like using $this
$ioc['WorkerLibrary'] = function($c){
	//no mention of $c, so we're not using it, but Pimple will pass it in regardless, so we need to accept
	return new WorkerLibrary;
};

//this creates the MasterLibrary and uses the self-referential $c to call upon WorkerLibrary and pass it as a dependency to MasterLibrary
$ioc['MasterLibrary'] = function($c){
	return new MasterLibrary($c['WorkerLibrary']);
};

//Pimple can also create random parameters...
$ioc['randomparameter'] = 'This is some random parameter';

/**
 * EXAMPLES END HERE REMOVE THE ABOVE TO SETUP YOUR OWN DEPENDENCIES
 */

 /**
 * PASSING THE IoC into the Global Codeigniter $config variable
 */
 
$config['ioc'] = $ioc;