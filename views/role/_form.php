<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\ModulesList;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Role */
/* @var $form yii\widgets\ActiveForm */

$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title").each(function(index) {
        jQuery(this).html("Module: " + (index + 1))
    });
});


jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title").each(function(index) {
        jQuery(this).html("Module: " + (index + 1))
    });
});
';

$this->registerJs($js);
?>
<style>
.panel-body {
    padding-bottom: 0px;
}
</style>
<div class="box box-primary">

  <div class="box-body chart-responsive">
  
    <div class="col-md-8">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'role_name')->textInput(['maxlength' => true, 'style' => 'width:250px;']) ?>
    
    <div class="panel panel-default" >
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => \app\models\ModulesList::find()->count(), // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelRolePermissions[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'module_id',
                    'new',
                    'view',
                    'save',
                    'remove',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <div class="caption font-red-sunglo" style="font-size: 15px;">
                <i class="fa fa-lock font-red-sunglo" ></i>
                <span class="caption-subject bold uppercase" > Modules Permissions</span>
            </div><br />
            <?php foreach ($modelRolePermissions as $i => $modelRolePermission): ?>
                <div class="item"><!-- widgetBody -->

                    <div>
                        <?php
                            // necessary for update action.
                            if (! $modelRolePermission->isNewRecord) {
                                echo Html::activeHiddenInput($modelRolePermission, "[{$i}]id");
                            }
                        ?>
                        
                        <div class="row" style="float: left;width: 90%;">
                            <div class="col-sm-4">
                                <?= $form->field($modelRolePermission, "[{$i}]module_id")->dropDownList(ArrayHelper::map(ModulesList::find()->where('is_active = 1')->All(), 'module_id', 'module_name'), ['prompt'=>'Select Modules'])->label(false) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelRolePermission, "[{$i}]new")->checkbox() ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelRolePermission, "[{$i}]view")->checkbox() ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelRolePermission, "[{$i}]save")->checkbox() ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelRolePermission, "[{$i}]remove")->checkbox() ?>
                            </div>
                            
                        </div>
                        <div class="pull-right">
                                <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            </div>
                    </div>
                    
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <?= $form->field($model, 'is_active')->dropDownList(['1' => 'Yes', '0' => 'No'],['style' => 'width:150px;']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>
    
  </div>
  
</div>

<?php
use yii\web\View;
$this->registerJs("   
   $('li.treeview').removeClass('active open');
   $('#Roles').addClass('active open');
   $('#role').addClass('active open');"
, View::POS_READY);
?>  