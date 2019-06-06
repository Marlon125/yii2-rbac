<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Role;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">

  <div class="box-body chart-responsive">

    <p>
        <?= Html::a('Create Admin', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'first_name',
            'last_name',
            'phone_number',
            'username',
            'email:email',
            // [
            //     'attribute' => 'password',
            //     'value' =>  function($data){ return Yii::$app->Permission->crypt('decrypt', $data->password); }
            // ],
            // 'authKey',
            // 'password_reset_token',
            // 'user_image',
            [
                'attribute' => 'user_level',
                'filter'=>ArrayHelper::map(Role::find()->asArray()->all(), 'role_id', 'role_name'),
                'value' =>  'role.role_name',                
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
   $('#admin').addClass('active open')
   
   //$('ul.treeview-menu li').removeClass('active');
   //$('#admin').addClass('active');"
, View::POS_READY);
?>  