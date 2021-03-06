<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 *
 * FORM : Sign Up
 * Describes the account registration form.
 *
 * @package     account
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

class SignupForm extends CFormModel
{
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public $organization;
    public $org_type;
    public $org_country;
    public $uaagreed;


    /**
     * Rules applying to the form fields.
     */
    public function rules()
    {
        return array(
            array('firstName, lastName, email, password, organization, org_type', 'required'),
            array('uaagreed', 'required','message'=>'You must accept the {attribute}.'),
            array('email','email'),
            array('email', 'unique','className'=>'User','attributeName'=>'email'),
            array('password', 'length', 'min'=>6),
            array('organization','safe'),
            array('uaagreed','boolean')
        );
    }

    /**
     * Customized attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'email'=>'Email',
            'firstName'=>'First name',
            'lastName'=>'Last name',
            'password'=>'Password',
            'organization'=>'Organization',
            'org_type'=>'Organization type',
            'org_country'=>'Organization country',
            'uaagreed'=>'Terms of service'
        );
    }
}