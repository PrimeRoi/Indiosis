<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 * 
 * VIEW : Main Layout
 * Main container layout for all pages.
 * 
 * @package     layout
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <meta name="description" content="A collaborative web-platform for industrial symbiosis." />
    <meta name="keywords" content="industrial symbiosis,industrial symbiosis practices,synergy,resource exchange,material exchange,social network" />
    <meta name="author" content="Frederic Andreae" />
    <meta name="copyright" content="&copy; 2012 UNIL/ROI">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl.'/css/css_reset.css' ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl.'/css/fonts/bitstream/fontface.css' ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl.'/css/fonts/open-sans/fontface.css' ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl.'/css/main.css' ?>" />
        
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    
    <?php
    // Global JS scripts
    Yii::app()->clientScript->registerCoreScript('jquery');
    Yii::app()->clientScript->registerCoreScript('jquery.ui');
    Yii::app()->clientScript->registerScriptFile(
            Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.layouts').'/primary.js'),
            CClientScript::POS_END);
    // Global JS constants
    Yii::app()->clientScript->registerScript('globalConstants','
        // Set global JS constants
        var BASE_URL = "'.Yii::app()->baseUrl.'";',
    CClientScript::POS_HEAD);
    ?>
    <!-- LinkedIn API import -->
    <script type="text/javascript" src="http://platform.linkedin.com/in.js">
      api_key: L4gyxZw6qwgyw1Gc2baz0HutNqeIafCLf7WhjHklXyGnBvcL65-ysOa1smgdN3lc
      authorize: true
    </script>
    <?php
    // Add fancybox to login link
    $this->widget('application.extensions.fancybox.EFancyBox', array(
        'target'=>'a#login_link',
        'config'=>array("padding" => 0, 'onComplete'=>'js:reparseLinkedIn')
    ));
    ?>
</head>
    
<body>
    <div id="wrapper">
        
        <!-- HEADER -->
        <div id="header_wrapper">
            <div id="header">
                <div id="toplogo">
                    <a href="<?php echo Yii::app()->baseUrl; ?>/"><img src="<?php echo Yii::app()->baseUrl.'/images/indiosis_headlogo.png'; ?>" alt="Indiosis" id="headerlogo"/></a>
                </div>
                <div id="topmenu">
                    <div class="topmenubutton"><a href="<?php echo Yii::app()->baseUrl; ?>/repository">PRACTICES<br/>REPOSITORY</a></div>
                    <div class="topmenubutton monoline"><a href="<?php echo Yii::app()->baseUrl; ?>/profile">My INDIOSIS</a></div>
                    <div class="topmenubutton"><a href="<?php echo Yii::app()->baseUrl; ?>/about">EXPERTS<br/>CORNER</a></div>
                    <div id="searchfield"><input type="text" name="spractice" value="search symbiosis practices.." class="no-uniform empty" /></div>
                </div>
            </div>
            <div id="infobar_wrapper">
                <div id="infobar" class="<?php echo (Yii::app()->user->isGuest)? 'guest':'logged' ; ?>">
                    <?php
                    if(Yii::app()->user->isGuest) {
                        echo '<a href="'.Yii::app()->baseUrl.'/account/login" id="login_link"><img src="'.Yii::app()->baseUrl.'/images/login_lock.gif'.'" alt="Secure login" />Log In</a>';
                    }
                    else {
                        echo Yii::app()->user->firstName." ".Yii::app()->user->lastName.' | '.'<a href="'.Yii::app()->baseUrl.'/account/logout">Logout</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
        
        <!-- MAIN CONTENT -->
        <div id="main_content">
            <?php echo $content; ?>
        </div>
        <div id="footer_push"></div>
    </div>
    
    <!-- FOOTER -->
    <div id="footer_wrapper">
    <div id="footer_inwrapper">
        <div id="footer">
            <div id="footer_links">
                <h4>More about Indiosis</h4>
                <a href="<?php echo Yii::app()->createUrl('help'); ?>">Help</a> | <a href="<?php echo Yii::app()->createUrl('privacy'); ?>">User Agreement & Privacy</a> | <a href="<?php echo Yii::app()->createUrl('about'); ?>">About Indiosis</a> | <a href="<?php echo Yii::app()->createUrl('contact'); ?>">Send us your feedback</a>
                <br/><br/><br/>
                <a href="#header" /><span>&#9650;</span> Back To Top</a>
            </div>
            <div id="footer_supportedby">
                <a href="http://www.roionline.org" target="_blank"><img src="<?php echo Yii::app()->baseUrl.'/images/roi_logo.png'; ?>" alt="ROI - Resource Optimization Initiative" /></a>
                <a href="http://www.unil.ch/hec" target="_blank"><img src="<?php echo Yii::app()->baseUrl.'/images/unilprime_logo.png'; ?>" alt="University of Lausanne"/></a>
                <div id="support_note">Supported by the<br/>University of Lausanne,<br/>in collaboration with ROI.</div>
            </div>
        </div>
        <div id="copyright">
            <div>
                <img src="<?php echo Yii::app()->baseUrl.'/images/indiosis_gray.png'; ?>" alt="Indiosis"/>
                <br/>
                <span>&copy; 2011-<?php echo date("Y"); ?></span><br/>All rights reserved.
            </div>
            <div>
                <img src="<?php echo Yii::app()->baseUrl.'/images/yii_logo.png'; ?>" alt="Yii Framework - version <?php echo Yii::getVersion(); ?>"/>
                <br/>Powered by<br/>Yii Framework.
            </div>
        </div>
    </div>
    </div>
</body>
</html>