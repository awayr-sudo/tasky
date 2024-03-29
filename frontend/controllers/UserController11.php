<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\User;
use common\models\Employee;
use common\models\VerifyEmailForm; 
use yii\web\NotFoundHttpException;
use common\models\LoginForm;
use yii\data\ActiveDataProvider;



class UserController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'only' => ['create', 'update', 'delete','index'], 
                'rules' => [
                    [
                        'allow' => false, 
                        'roles' => ['?'], 
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'update', 'delete','index'],
                        'roles' => ['user'], 
                    ],
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionCreate()
    {
        $model = new User();
    
        if ($this->request->isPost) {
        
            if ($model->load($this->request->post())) {
                $model->auth_key = Yii::$app->security->generateRandomString();
                $employee = Employee::findOne(['id' => $model->id]);
                if ($employee !== null) {
                    $model->username = $employee->name;
                    $model->email = $employee->email_address;
                } 
             
                $model->setPassword($model->Password); 
                $model->generateEmailVerificationToken();
    
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'User created successfully');         
               }
            }
        } else {
            $model->loadDefaultValues();

        }
    
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
    
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                print_r($model->attributes);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
    
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    protected function findModel($id)
{
    if (($model = User::findOne($id)) !== null) {
        return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
}

public function actionDelete($id)
{
    $this->findModel($id)->delete();

    return $this->redirect(['index']);
}

   
}