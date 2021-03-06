<?php
/**
 * Created by PhpStorm.
 * User: TuanPham
 * Date: 11/19/2016
 * Time: 9:09 PM
 */
namespace frontend\widgets;

use common\models\Category;
use yii\base\Widget;
use Yii;
use yii\helpers\Url;

class MenuLeft extends Widget{

    public $message;

    public  function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public  function run()
    {
        $menu = Category::find()
            ->andWhere(['status' => Category::STATUS_ACTIVE])
            ->andWhere(['parent_id' => null])
            ->all();
        return $this->render('menu-left',[
            'menu'=>$menu
        ]);
    }

    public static function getChildMenuLeft($id){
        $all_child = Category::find()
            ->andWhere(['status'=>Category::STATUS_ACTIVE])
            ->andWhere(['parent_id'=>$id])
            ->all();
        $st = new MenuLeft();
        if(isset($all_child) && !empty($all_child)){
            return $st->render('child-menu-left',['all_child'=>$all_child]);
        }
    }
}
