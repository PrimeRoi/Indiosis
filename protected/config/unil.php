<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 *
 * UNIL Configuration File
 * Describes all the configuration variables of Indiosis.
 *
 * @package     all
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI 2012
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

    // Unique application ID
    'id'=>'indiosis-unil',

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
        'application.models.ar_models.*',
        'application.models.*',
        'application.models.forms.*',
        'application.components.*'
    ),

    'components'=>array(

        // Simplify URLs
        'urlManager'=>array(
            'showScriptName'=>true,
            'urlFormat'=>'path',
            'rules'=>array(
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            )
        ),

        // Setup user authentication rules
        'user'=>array(
            'allowAutoLogin'=>true,
            'loginUrl'=> '/indiosis/',
        ),

        // Setup the DB connexion
        'db'=>array(
                'connectionString' => 'mysql:host=localhost;dbname=indiosis_main',
                'emulatePrepare' => true,
                'username' => 'wwwindio',
                'password' => 'indio4mysql',
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
            'basePath'=>_joinpath($homePath,'../../../prod/indiosis/assets'),
            'baseUrl'=>'/indiosis/assets'
        ),

        // Google Analytics
        'googleAnalytics' => array(
            'class' =>'ext.TPGoogleAnalytics.TPGoogleAnalytics',
            'account' => 'UA-36265192-1',
            'autoRender' => true
        )
    ),
    // <== compenents end.

    // Other parameters (accessible through Yii::app()->params['paramName'])
    'params'=>array(
        'indiosisEmail'=>'wwwindio@unil.ch',
        'notificationEmail'=>'wwwindio@unil.ch',
        'adminEmail'=>'fred@roi-online.org',
        'indiosisVersion' => 'beta',
        'indiosisVersionNumber' => '0.2',
        'ajaxSuccess' => 'OK',
        'ajaxFailure' => 'ERROR',
        'linkedinKey' => 'h2c4xaig3qq2',
        'linkedinSecret' => 'nFW1p1Z4PWvsVVrB',
        'linkedinBackUrl' => 'http://www2.unil.ch/indiosis/index.php/account/linkedinhandle',
        'countryList' => include( _joinpath(_joinpath($homePath,'protected'),'data').'/country-list.php'),
        'isbcScales' => array('wastex'=>'Waste exchange','intra'=>'Intra-facility','ecopark'=>'Eco-industrial park','local'=>'Local','regional'=>'Regional','mutual'=>'Mutualization')
    )
);