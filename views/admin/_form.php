<?php

use yii\helpers\Html;
use app\models\Role;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<section class="col-lg-6">

<div class="box box-primary">

  <div class="box-body chart-responsive">
  
    <div class="col-md-8">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'class' => 'form-horizontal']); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'value'=>$model->isNewRecord ? '' : Yii::$app->Permission->crypt('decrypt', $model->password)]) ?-->

    <!--?= $form->field($model, 'authKey')->textInput(['maxlength' => true]) ?-->

    <!--?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?-->

    <!--?= $form->field($model, 'user_image')->textInput(['maxlength' => true]) ?-->
    
    <!--?= $form->field($model, 'is_active')->dropDownList([ '0' => 'No', '1' => 'Yes']) ?-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    </div>
    
  </div>
  
</div>

</section>

<section class="col-lg-4">

     <?php
     
        $src = "../web/img/profile-img.png";
        if(!$model->isNewRecord && $model->user_image != '')
        {                                          
            $src = "../".$model->user_image;                   
        }
    ?>
        <div style="border: 1px solid #e7ecf1 !important" class="portlet light profile-sidebar-portlet ">                                        
                                        <div class="profile-userpic" >
                                            <img style="border: 1px solid #e7ecf1 !important;height: 150px;" src="<?php echo $src; ?>" id="previewimg" class="img-responsive" alt=""> </div>
                                        
                                        <div class="profile-usertitle">
                                            <div class="profile-usertitle-name" style="cursor: pointer;" onclick="$('#admin-img').trigger('click')"> Upload Avatar </div>
                                            <div style="display: none;"><?= $form->field($model, 'img')->fileInput() ?></div>
                                            <div class="profile-usertitle-job"> User Level </div>
                                        </div>
                                        <div class="profile-userbuttons" style="padding-left: 55px;">
                                            <?= $form->field($model, "user_level")->dropDownList(ArrayHelper::map(Role::find()->All(), 'role_id', 'role_name'), ['style'=>'width:200px;', 'prompt'=>''])->label(false) ?>
                                        </div>                                       
                                    </div>

</section>

<?php
use yii\web\View;
$this->registerJs("
   $('li.treeview').removeClass('active open');
   $('#Roles').addClass('active open');
   $('#admin').addClass('active open')
   
   $('#admin-img').change(function() {
        if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = imageIsLoaded;
        reader.readAsDataURL(this.files[0]);
        }
   });
   
   function imageIsLoaded(e) {            
        $('#previewimg').attr('src', e.target.result);
        $('#previewimg').show();
   };"
, View::POS_READY);
?>  