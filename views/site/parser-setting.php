<?php
/** @var \app\models\ParserSettings $model */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="row">
    <?php if(!empty($alert)):?>
        <div class="alert alert-info">
            <?=$alert?>
        </div>
    <?php endif;?>
    <div class="col-md-offset-3 col-md-6 text-center">
        <?php $form =  ActiveForm::begin();?>
        <?= $form->field($model, 'start_parsing_time')
            ->textInput()
            ->label('Время запуска парсера в формате: Часы:Минуты:Секунды')?>
        <div class="form-group">
            <div class="">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>

