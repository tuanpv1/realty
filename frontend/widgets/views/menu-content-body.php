<?php
/**
 * Created by PhpStorm.
 * User: TuanPham
 * Date: 12/23/2016
 * Time: 6:06 PM
 */
?>
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
    <?php
    $i = 0;
    if($cat){
        foreach($cat as $key => $item){
            /** @var $item \common\models\Category */
            if($i == 0) {
                ?>
                <li class="active"><a href="<?= \yii\helpers\Url::to(['category/index','id'=>$item->id ]) ?>"><?= $item->display_name ?></a></li>
                <?php
            }else{
                ?>
                <li><a href="<?= \yii\helpers\Url::to(['category/index','id'=>$item->id ]) ?>"><?= $item->display_name ?></a></li>
                <?php
            }
            $i++;
        }
    }
    ?>
    </ul>
</div>
