<?php
/* 
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 * 
 * Main Configuration File
 * Describes all the configuration variables of Indiosis.
 * 
 * @package     all
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */

// Include helper functions
require_once( dirname(__FILE__) . '/../components/helpers.inc');

// Define home folder path
$homePath = dirname(__FILE__) . '/../..';

// Simple function to join paths
function _joinpath($dir1, $dir2) {
    return realpath($dir1 . DIRECTORY_SEPARATOR . $dir2);
}

return array(
    
    // Path to the protected folder
    'basePath'=>_joinpath($homePath, 'protected'),
    
    // Name of the application
    'name'=>'Indiosis',
    
    // Default controller to use
    'defaultController'=>'home',
    
    // Path to runtime folder
    'runtimePath' => _joinpath($homePath, 'runtime'),
    
    // User language
    'language'=>'en',
 
    // Message and views language
    'sourceLanguage'=>'en',
 
    // Application charset
    'charset'=>'utf-8',
    
    // Preloading 'log' component
    'preload'=>array('log'),
    
    // Autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
    ),
    
    // Other parameters (accessible through Yii::app()->params['paramName'])
    'params'=>array(
        'indiosisEmail'=>'info@indiosis.com',
        'notificationEmail'=>'fred@roi-online.org',
        'adminEmail'=>'fred@roi-online.org',
        'indiosisVersion' => 'alpha',
        'indiosisVersionNumber' => '1',
        'ajaxSuccess' => 'OK',
        'ajaxFailure' => 'ERROR',
    ),
    
    //To be uncommented when auto-creation panel is needed.
    'modules'=>array(
        'gii'=>array(
                'class'=>'system.gii.GiiModule',
                'password'=>'roi',
                // If removed, Gii defaults to localhost only. Edit carefully to taste.
                'ipFilters'=>array('127.0.0.1','::1'),
        ),
    ),
    
    'components'=>array(
        
        // Setup user authentication rules
        'user'=>array(
            'allowAutoLogin'=>true,
            'loginUrl'=>null
        ),

        // Simplify URLs
        'urlManager'=>array(
            'urlFormat'=>'path',
            'rules'=>array(
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ),
            'showScriptName'=>'false'
        ),
        
        // Setup the DB connexion
        'db'=>array(
                'connectionString' => 'mysql:host=localhost;dbname=indiosis',
                'emulatePrepare' => true,
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
        ),
        
        // Redirect errors to Indiosis error page
        'errorHandler'=>array(
            // use 'home/error' action to display errors
            'errorAction'=>'home/error',
        ),
        
        // Enables logs
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                )
            )
        ),
        
        // Specify the asset folder path
        'assetManager'=>array(
            'basePath'=>_joinpath($homePath,'webroot/assets'),
            'baseUrl'=>'assets'
        )
    )
);