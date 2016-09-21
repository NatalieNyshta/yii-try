<?php
use \yii\widgets\ActiveForm;
use \yii\web\View;
use \yii\helpers\Html;
use \backend\models\customer\CustomerRecord;
use \backend\models\customer\PhoneRecord;

/**
 * Add customer UI.
 *
 * @var View $this
 * @var CustomerRecord $customer
 * @var PhoneRecord $phone
 */

$form = ActiveForm::begin([
    'id' => 'add-customer-form'
]);

echo $form->errorSummary([$customer, $phone]);
echo $form->field($customer, 'name');
echo $form->field($customer, 'birth_date');
echo $form->field($customer, 'notes');

echo $form->field($phone, 'number');

echo Html::submitButton('Submit', ['class' => 'btn btn-primary']);
ActiveForm::end();