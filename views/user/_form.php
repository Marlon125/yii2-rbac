<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-primary">

  <div class="box-body chart-responsive">
   
    <div class="col-lg-12">
        <?php if(Yii::$app->session->hasFlash('alert')): ?>
                     <div class="alert alert-warning alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
                        <?= Yii::$app->session->getFlash('alert') ?>
                     </div>
        <?php endif; ?>        
    </div>
    
    <div class="col-lg-4">

    <?php $form = ActiveForm::begin(); ?>

    <!--?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?-->

    <!--?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?-->

    <!--?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?-->

    <!--?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?-->

    <!--?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?-->

    <!--?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?-->

    <!--?= $form->field($model, 'user_image')->textInput(['maxlength' => true]) ?-->

    <!--?= $form->field($model, 'user_level')->dropDownList([ 'Super Admin' => 'Super Admin', 'Admin' => 'Admin', ], ['prompt' => '']) ?-->
    
    <?= $form->field($model, 'oldpass')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'newpass')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'repeatnewpass')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>

  </div>

</div>