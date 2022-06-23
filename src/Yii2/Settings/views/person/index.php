<?php

/**
 * @var View $this
 */

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use ZnCore\Base\I18Next\Facades\I18Next;

$this->title = I18Next::t('person', 'person.title');

?>

<?php $form = ActiveForm::begin() ?>

<div class="form-row">
    <div class="form-group col-md-12">
        <?= Html::activeLabel($model, 'username'); ?>
        <?= Html::activeTextInput($model, 'username', ['class' => 'form-control']); ?>
        <?= Html::error($model, 'username', ['class' => 'text-danger']); ?>
    </div>
</div>

<?= Html::submitButton(I18Next::t('core', 'action.save'), ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end() ?>
