<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RoleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">

  <div class="box-body chart-responsive">

    <p>
        <?= Html::a('Create Role', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'role_id',
            'role_name',
            [
                'attribute' => 'is_active',
                'value' =>  function($data) { return $data->is_active == 1 ? 'Yes' : 'No'; }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

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