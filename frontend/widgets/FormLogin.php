<?php
/**
 * Created by PhpStorm.
 * User: TuanPham
 * Date: 11/19/2016
 * Time: 9:09 PM
 */
namespace frontend\widgets;

use frontend\models\LoginForm;
use frontend\models\SignupForm;
use yii\base\Widget;
use Yii;

class FormLogin extends Widget{

    public $message;

    public  function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public  function run()
    {
        $model_register = new SignupForm();
        $model = new LoginForm();
        return $this->render('form-login',[
            'model' => $model,
            'model_register' => $model_register,
        ]);
    }
}