<?php

namespace frontend\controllers;

use common\modules\auth\models\AuthItem;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii; 

/**
 * RbacController implements the CRUD actions for AuthItem model.
 */
class RbacController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all AuthItem models.
     *
     * @return string
     */
    // public function actionAssignment()
    // {
    //     $auth = Yii::$app->authManager;
    //     $user = $auth->createRole('user');
    //     $employee = $auth->createRole('employee');
        
    //     $auth->assign($user, 1);
    //     $auth->assign($employee, 2);

    // }


//     public function actionAssignment()
// {
//     $auth = Yii::$app->authManager;
     
//     $admin = $auth->createRole('admin');
//     $auth->assign($admin, 3);
       


//     $auth->removeAllAssignments();

//     $userRole = $auth->getRole('user');
//     $employeeRole = $auth->getRole('employee');

//     if ($userRole !== null && $employeeRole !== null) {
//         $users = \common\models\User::find()->all(); 
        
//         foreach ($users as $user) {
          
//             $hasUserRole = $auth->checkAccess($user->id, 'user');
//             $hasEmployeeRole = $auth->checkAccess($user->id, 'employee');

//             if (!$hasUserRole && !$hasEmployeeRole) {
             
//                 if ($user->role === 'user') {
//                     $auth->assign($userRole, $user->id);
//                 } elseif ($user->role === 'employee') {
//                     $auth->assign($employeeRole, $user->id);
//                 }
//             }
//         }
//     }
// }

public function actionAssignment()
{
    $auth = Yii::$app->authManager;
    
    // Remove all previous role assignments
    $auth->removeAllAssignments();

    // Define roles
    $adminRole = $auth->getRole('admin');
    $employeeRole = $auth->getRole('employee');
    $userRole = $auth->getRole('user');

    // Fetch all users
    $users = \common\models\User::find()->all(); 
        
    foreach ($users as $user) {
        // Assign roles based on user's role attribute
        switch ($user->role) {
            case 'admin':
                $auth->assign($adminRole, $user->id);
                break;
            case 'employee':
                $auth->assign($employeeRole, $user->id);
                break;
            case 'user':
                $auth->assign($userRole, $user->id);
                break;
            default:
                // Handle unknown roles, if necessary
                break;
        }
    }
}
    


     public function actionCreate_role()
     {   

        $auth = Yii::$app->authManager;
        $user = $auth->createRole('user');
        $auth->add($user);

        $create = $auth->createPermission('auth/employee/create');
       
     
        $index= $auth->createPermission('auth/employee/index');
       
        $update= $auth->createPermission('auth/employee/update');
      
        $delete= $auth->createPermission('auth/employee/delete');
       
    
        $auth->addChild($user, $create);
        $auth->addChild($user, $index);
        $auth->addChild($user, $update);
        $auth->addChild($user, $delete);

        $employee = $auth->createRole('employee');
        $auth->add($employee);
    

        $create = $auth->createPermission('auth/table_lists/create');
        $index = $auth->createPermission('auth/table_lists/index');
        $update = $auth->createPermission('auth/table_lists/update');
        $delete = $auth->createPermission('auth/table_lists/delete');
   
        $auth->addChild($employee, $create);
        $auth->addChild($employee, $index);
        $auth->addChild($employee, $update);
        $auth->addChild($employee, $delete);
         
        $admin = $auth->createRole('admin');
        $auth->add($admin);

        $create = $auth->createPermission('auth/user/create');
        $index = $auth->createPermission('auth/user/index');
        $update = $auth->createPermission('auth/user/update');
        $delete = $auth->createPermission('auth/user/delete');
   
        $auth->addChild($admin, $create);
        $auth->addChild($admin, $index);
        $auth->addChild($admin, $update);
        $auth->addChild($admin, $delete);

      

     }




    public function actionCreate_permission()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        
    
        
        // add "create" permission
        $create = $auth->createPermission('auth/employee/create');
        $create->description = 'Create employee';
        $auth->add($create);
    
        // add "index" permission
        $index = $auth->createPermission('auth/employee/index');
        $index->description = 'View index';
        $auth->add($index);
    
 
        // add "update" permission
        $update = $auth->createPermission('auth/employee/update');
        $update->description = 'Update employee';
        $auth->add($update);
    
        // add "delete" permission
        $delete = $auth->createPermission('auth/employee/delete');
        $delete->description = 'Delete employee';
        $auth->add($delete);
         
        $indexTableLists = $auth->createPermission('auth/table_lists/index');
        $indexTableLists->description = 'View table lists';
        $auth->add($indexTableLists);
    
        $viewTableLists = $auth->createPermission('auth/table_lists/view');
        $viewTableLists->description = 'View table details';
        $auth->add($viewTableLists);
    
        $createTableLists = $auth->createPermission('auth/table_lists/create');
        $createTableLists->description = 'Create table';
        $auth->add($createTableLists);
    
        $updateTableLists = $auth->createPermission('auth/table_lists/update');
        $updateTableLists->description = 'Update table';
        $auth->add($updateTableLists);
    
        $deleteTableLists = $auth->createPermission('auth/table_lists/delete');
        $deleteTableLists->description = 'Delete table';
        $auth->add($deleteTableLists);


        $indexUser = $auth->createPermission('auth/user/index');
        $indexUser->description = 'View index';
        $auth->add($indexUser);
    
    
        $createUser = $auth->createPermission('auth/user/create');
        $createUser->description = 'Create table';
        $auth->add($createUser);
    
        $updateUser = $auth->createPermission('auth/user/update');
        $updateUser->description = 'Update table';
        $auth->add($updateUser);
    
        $deleteUser = $auth->createPermission('auth/user/delete');
        $deleteUser->description = 'Delete table';
        $auth->add($deleteUser);
    
    
 

     
    }
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AuthItem::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'name' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $name Name
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($name)
    {
        return $this->render('view', [
            'model' => $this->findModel($name),
        ]);
    }

    /**
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new AuthItem();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'name' => $model->name]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $name Name
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($name)
    {
        $model = $this->findModel($name);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'name' => $model->name]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $name Name
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($name)
    {
        $this->findModel($name)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $name Name
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($name)
    {
        if (($model = AuthItem::findOne(['name' => $name])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
