<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Role */

$this->title = 'Update Role: ' . ' ' . $model->role_id;
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->role_id, 'url' => ['view', 'id' => $model->role_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="role-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelRolePermissions' => $modelRolePermissions,
    ]) ?>

</div>
