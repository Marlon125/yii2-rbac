<?php
 
/**
 * @author Prakash S
 * @copyright 2017
 */
 
namespace app\components;
 
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
 
class ModulesPermission extends Component
{

    /**
     * Rest Description: Your endpoint description.
     * Rest Fields: ['field1', 'field2'].
     * Rest Filters: ['filter1', 'filter2'].
     * Rest Expand: ['expandRelation1', 'expandRelation2'].
     */
    public function getMenus()
    {
        $role_id = Yii::$app->user->identity->user_level;
        $modules = \app\models\RolePermission::find()
                             ->select('ML.module_name, ML.controller, ML.icon')
                             ->join('LEFT JOIN', 'modules_list AS ML', 'ML.module_id = role_module_permission.module_id')
                             ->where('role_id = :role_id', [':role_id' => $role_id])
                             ->andWhere('role_module_permission.view = :view', [':view' => 1])
                             ->andWhere('is_active = :is_active', [':is_active' => 1])
                             ->asArray()->all();
            
        $items = array();
        $items[] = '<li id="dashboard"><a href="'. \yii\helpers\Url::to(['/']).'"><span class="fa fa-dashboard"></span> Dashboard</a></li>';
        for($i=0; $i<count($modules); $i++)
        {
            $items[] = '<li id="'.$modules[$i]['controller'].'"><a href="'. \yii\helpers\Url::to([$modules[$i]['controller'].'/']).'"><span class="fa '.$modules[$i]['icon'].'"></span> '.$modules[$i]['module_name'].'</a></li>';
        }
        return $items;
    }
    
    public function getPermission()
    {
        $actions = array();
        $actions['index']  = 'view';
        $actions['view']   = 'view';
        $actions['create'] = 'new';
        $actions['update'] = 'save';
        $actions['delete'] = 'remove';
        
        $role_id = Yii::$app->user->identity->user_level;    	
        $action = $actions[Yii::$app->controller->action->id];
        $controller = Yii::$app->controller->id;
        
        $permission = \app\models\RolePermission::find()
                             ->select($action)
                             ->join('LEFT JOIN', 'modules_list AS ML', 'ML.module_id = role_module_permission.module_id')
                             ->where('role_id = :role_id', [':role_id' => $role_id])
                             ->andWhere($action.' = :'.$action, [':'.$action => 1])
                             ->andWhere('controller = :controller', [':controller' => $controller])
                             ->one();
        return $permission[$action] ? true : false;
    }
}
 
?>