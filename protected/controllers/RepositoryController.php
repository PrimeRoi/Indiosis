<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 *
 * CONTROLLER : Home Controller
 * Handles all home pages related actions.
 *
 * @package     repository
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

class RepositoryController extends IndiosisController
{

    public $menuActions;

    /**
     * Specify the access rules for this controller.
     */
    public function accessRules()
    {
        return array(
            array('deny',
                'actions'=>array('newcase'),
                'users'=>array("?")
            )
        );
    }

    /**
     * Run before every action.
     * @param CAction $action The action that'll be executed.
     * @return boolean Wether or not to continue.
     */
    protected function beforeAction($action)
    {
        $this->defaultAction = 'browse';
        $this->breadcrumbsLinks = array('IS Repository'=>'index');
        if(!Yii::app()->user->isGuest) {
            $this->menuActions = array( 'Add ISBC'=>$this->createUrl('repository/newcase'),
                                        'Auto-import ISBCs'=>$this->createUrl('repository/importxcel'),
                                        'Custom Categories'=>$this->createUrl('repository/customcategory'));
        }
        return true;
    }

    /**
     * Browse the IS repository.
     */
    public function actionBrowse()
    {
        $this->breadcrumbsLinks = array('IS Repository'=>'index','All ISBCs');
        $resourceModel = new ClassCode;
        // retrieve all stored ISBCs
        $isbcs = ISBC::model()->findAll();

        $this->render('repository',array('resourceModel'=>$resourceModel,'isbcs'=>$isbcs));
    }

    /**
     * Add a new IS case into the repository.
     */
    public function actionNewCase()
    {
    	$this->breadcrumbsLinks = array('IS Repository'=>$this->createUrl('repository/index'),'ADMIN : New ISBC');

        $IScase = new ISBC;
        $location = new Location;
        $symbioticLink = new SymbioticLinkage;

        if(isset($_POST['ISBC'], $_POST['Location'], $_POST['SymbioticLinkage']))
        {
            $IScase->attributes = $_POST['ISBC'];
            $IScase->added_on = date("Y-m-d H:i:s");
            $location->attributes = $_POST['Location'];
            $location->label = 'IS Case Region';
            $symbioticLink->attributes = $_POST['SymbioticLinkage'][1];
            $symbioticLink->ISCase_id = 0;

            if($IScase->validate() && $location->validate() && $symbioticLink->validate()) {
                if($IScase->save())
                {
                    $location->ISCase_id = $IScase->id;
                    $location->save();
                    foreach($_POST['SymbioticLinkage'] as $ISClass) {
                        $IScC = new SymbioticLinkage;
                        $IScC->ISCase_id = $IScase->id;
                        $IScC->attributes = $ISClass;
                        $IScC->save();
                    }
                    $this->render('//layouts/notifications', array('message'=>"The IS case is now available in the main repository.",
                                                                    'title'=>"Saved to repository",
                                                                    'backUrl'=>$this->createUrl('repository/index')));
                    Yii::app()->end();
                }
            }
    	}

        $ISIClist = ResourceManager::getISICList();
        $HScodes = ResourceManager::getHSList();

    	$this->render('newcase',array('IScase'=>$IScase,
                                        'location'=>$location,
                                        'SymbioticLink'=>$symbioticLink,
                                        'ISIClist'=>$ISIClist,
                                        'HScodes'=>$HScodes));
    }

    public function actionViewCase()
    {
        $this->menuActions['Edit case']=Yii::app()->createUrl('repository/editcase');
        $this->render('iscase');
    }


    /**
     * AJAX/JSON - Lookup a material name and retrieve possible matches.
     */
    public function actionMaterialAutocomplete()
    {
        if (Yii::app()->request->isAjaxRequest && isset($_GET['q']))
        {
            $materialList = array();
            $materialTree = ResourceManager::getHSCodeTree(0,false);
            foreach($materialTree as $material) {
                if(stripos($material['description'],$_GET['q'])!==false) {
                    $materialList[] = $material['description'].'|'.$material['code'];
                }
            }
            // return the material list
            echo implode("\n", $materialList);
            //echo CJSON::encode($materialList);
        }
    }

    /**
     * Auto inserts ISBCs from an Excel file (based on provided template).
     */
    public function actionImportXcel()
    {
        $this->breadcrumbsLinks = array('IS Repository'=>'index','Import ISBCs');

        $xcelform = new ISBCXcelForm;

        if(isset($_POST['ISBCXcelForm']))
        {
            $xcelform->xcelfile = CUploadedFile::getInstance($xcelform,'xcelfile');
            if($xcelform->validate())
            {
                echo 'done<pre>';
                print_r($xcelform->parsedISBCs);
                echo '</pre>';
                // $xcelform->parsedISBCs; // save this
                echo "Well formated ready to be saved";
                die();
            }
        }

        $this->render('xcelimport',array('xcelform'=>$xcelform));
    }

    public function actionCustomCategory()
    {
        $this->breadcrumbsLinks = array('IS Repository'=>$this->createUrl('repository/index'),'Custom Categories ');

        $customCategory = new CustomCategory;

        if(isset($_POST['CustomCategory']))
        {
            $customCategory->attributes = $_POST['CustomCategory'];
            $customClass = new CustomClass;
            $customClass->code = 'INDSIS-'.$_POST['CustomCategory']['id'];
            $customClass->name = $customCategory->name;
            $customClass->description = $customCategory->description;
            // depending on which classification system is being used as reference
            switch ($customCategory->classification) {
                case 'ISIC':
                    $customCategory->MatchingCode_number = 'ISIC-'.$customCategory->MatchingCode_number;
                    $customClass->MatchingCode_number = $customCategory->MatchingCode_number;
                    break;
                default:
                    $customClass->MatchingCode_number = $customCategory->MatchingCode_number;
                    break;
            }
            $customCategory->code = $customClass->code;

            if($customCategory->validate()) {
                $customClass->save();
            }
            else {
                    $customCategory->MatchingCode_number = str_replace("ISIC-","",$customCategory->MatchingCode_number);
            }
        }

        // retrieve all current custom classes
        $customClasses = CustomClass::model()->findAll();

        // $ISIClist = ResourceManager::getISICList();
        // $HScodes = ResourceManager::getHSList();

        $this->render('customCat',array('customCategory'=>$customCategory,
                                        'customClasses'=>$customClasses));
    }
}