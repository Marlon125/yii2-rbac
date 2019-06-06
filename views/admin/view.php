<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */

$this->title = 'View Admin: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">

  <div class="box-body chart-responsive">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <section class="col-lg-7">
    <section class="col-lg-12">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_name',
            'last_name',
            'phone_number',
            'username',
            'email:email',
            [
                'attribute'=>'password',
                'value'=>Yii::$app->Permission->crypt('decrypt', $model->password),
            ],   
            //'password',
            //'authKey',
            //'password_reset_token',
            //'user_image',
            [
                'attribute'=>'is_active',
                'value'=>$model->is_active ? 'Yes' : 'No',
            ],   
        ],
    ]) ?>
    </section>
    </section>
    
    <section class="col-lg-4">

     <?php
        $src = "../web/img/profile-img.png";
        if($model->user_image != '')
        {                                          
            $src = "../" . $model->user_image;               
        }
    ?>
        <div style="border: 1px solid #e7ecf1 !important" class="portlet light profile-sidebar-portlet ">
            <div class="profile-userpic" >
                <img style="border: 1px solid #e7ecf1 !important;height: 150px;" src="<?php echo $src; ?>" class="img-responsive" alt=""> 
            </div>
            <div class="profile-usertitle">
                <div class="profile-usertitle-name"> <?php echo $model->first_name . ' ' . $model->last_name; ?> </div>
                <div class="profile-usertitle-job"> <?php echo $model->role->role_name; ?> </div>
            </div>
                                               
        </div>

</section>
  </div>

</div>

<?php
use yii\web\View;
$this->registerJs("
   $('li.treeview').removeClass('active open');
   $('#Roles').addClass('active open');
   $('#admin').addClass('active open')
", View::POS_READY);
?>
