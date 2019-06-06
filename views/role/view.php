<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Role */

$this->title = "Views Role: ".$model->role_id;
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>.summary{display: none;}</style>
<div class="box box-primary">

  <div class="box-body chart-responsive">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->role_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->role_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'role_id',
            'role_name',
            [
                'attribute'=>'is_active',
                'value'=>$model->is_active ? 'Yes' : 'No',
            ],
        ],
    ]) ?>

  </div>

</div>

<div class="box box-primary">

  <div class="box-body chart-responsive">
  
    <div class="caption font-red-sunglo" style="font-size: 15px;">
        <i class="fa fa-lock font-red-sunglo"></i>
        <span class="caption-subject bold uppercase"> Modules Permissions</span>
    </div><br />

    <?= GridView::widget([
        'dataProvider' => $modelRolePermissions,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'module.module_name',
            //'role.role_name',
            [
                'attribute' => 'new',
                'format' => 'html',
                'value' =>  function($data) { return $data->new ? ' <img src ="' .'../web/img/tick.png" height="25"' . '>' : ' <img src ="' .'../web/img/wrong.png" height="15"' . '>'; }
            ],
            [
                'attribute' => 'view',
                'format' => 'html',
                'value' =>  function($data) { return $data->view ? ' <img src ="' .'../web/img/tick.png" height="25"' . '>' : ' <img src ="' .'../web/img/wrong.png" height="15"' . '>'; }
            ],
            [
                'attribute' => 'save',
                'format' => 'html',
                'value' =>  function($data) { return $data->save ? ' <img src ="' .'../web/img/tick.png" height="25"' . '>' : ' <img src ="' .'../web/img/wrong.png" height="15"' . '>'; }
            ],
            [
                'attribute' => 'remove',
                'format' => 'html',
                'value' =>  function($data) { return $data->remove ? ' <img src ="' .'../web/img/tick.png" height="25"' . '>' : ' <img src ="' .'../web/img/wrong.png" height="15"' . '>'; }
            ],
        ],
    ]); ?>

    </div>
    
  </div>
  

<?php
use yii\web\View;
$this->registerJs("
   $('li.treeview').removeClass('active open');
   $('#Roles').addClass('active open');
   $('#role').addClass('active open');
", View::POS_READY);
?>