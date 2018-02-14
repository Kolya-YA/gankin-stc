<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ContactForm extends CFormModel
{
    public $name;
    public $email;
    public $body;
    public $verifyCode;

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            ['name, email, body', 'required'],
            ['name', 'length', 'max'=>65],
            ['email', 'length', 'max'=>254],
            ['body', 'length', 'max'=>1024],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
        ];
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
            'body' => Yii::t('form', 'message'),
            'phone' => Yii::t('form', 'phone'),
            'name' => Yii::t('form', 'name'),
        ];
    }
}