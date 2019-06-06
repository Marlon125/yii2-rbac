<?php

namespace app\controllers;

use Yii;
use app\models\Role;
use app\models\RolePermission;
use app\models\RoleSearch;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * RoleController implements the CRUD actions for Role model.
 */
class RoleController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    
    public function beforeAction($event){
        if(Yii::$app->Permission->getPermission())
            return parent::beforeAction($event);
        else
            $this->redirect(['site/permission']);
    }

    /**
     * Rest Description: Your endpoint description.
     * Rest Fields: ['field1', 'field2'].
     * Rest Filters: ['filter1', 'filter2'].
     * Rest Expand: ['expandRelation1', 'expandRelation2'].
     */     
    public function actionIndex()
    {
        $searchModel = new RoleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Role model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $query = RolePermission::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=> ['defaultPageSize' => 50],
        ]);
        $query->andFilterWhere(['role_id' => $id]);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelRolePermissions' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Role model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Role();
        $modelRolePermissions = [new RolePermission()];

        if ($model->load(Yii::$app->request->post())) {
                        
                $modelRolePermissions = Role::createMultiple(RolePermission::classname());
                Role::loadMultiple($modelRolePermissions, Yii::$app->request->post());
            
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelRolePermissions as $modelRolePermission) {
                            $modelRolePermission->role_id = $model->role_id;
                            $modelRolePermission->added_at = date('Y-m-d H:i:s');
                            $modelRolePermission->added_by = Yii::$app->user->identity->id;
                            if (! ($flag = $modelRolePermission->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->role_id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
                return $this->redirect(['index']);
        } else {
            
            return $this->render('create', [
                'model' => $model,
                'modelRolePermissions' => (empty($modelRolePermissions)) ? [new RolePermission()] : $modelRolePermissions,
            ]);
        }
    }

    /**
     * Updates an existing Role model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelRolePermissions = $model->roleModulePermissions;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
                                
                $oldIDs = ArrayHelper::map($modelRolePermissions, 'id', 'id');
                $modelRolePermissions = Role::createMultiple(RolePermission::classname(), $modelRolePermissions);
                Role::loadMultiple($modelRolePermissions, Yii::$app->request->post());
                $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelRolePermissions, 'id', 'id')));
            
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            RolePermission::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelRolePermissions as $modelRolePermission) {
                            $modelRolePermission->role_id = $model->role_id;
                            $modelRolePermission->added_at = date('Y-m-d H:i:s');
                            $modelRolePermission->added_by = Yii::$app->user->identity->id;
                            if (! ($flag = $modelRolePermission->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->role_id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
                return $this->redirect(['index']);
        } else {
            
            return $this->render('create', [
                'model' => $model,
                'modelRolePermissions' => (empty($modelRolePermissions)) ? [new RolePermission()] : $modelRolePermissions,
            ]);
        }
    }

    /**
     * Deletes an existing Role model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Role model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Role the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Role::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
