<?php
/* @var $this \yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\grid\GridView;

?>

<div class="row">
    <div class="col-md-12">
        <?=GridView::widget([
            'dataProvider' => $dataProvider,
        ])?>
    </div>
</div>
