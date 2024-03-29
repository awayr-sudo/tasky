<?php

namespace frontend\modules\v1\controllers;



use yii\rest\ActiveController;

use common\models\User;
use yii\web\Response;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;



/**
 * Default controller for the `v1` module
 */
class UserController extends ActiveController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public $modelClass = "common\models\User";
    
    public function actionLogin()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $request = \Yii::$app->request;
        $username = $request->post('username');
        $password = $request->post('password');

        $user = User::findByUsername($username);
        if ($user && $user->validatePassword($password)) {
            return ['status' => 'success', 'message' => 'Login successful', 'data' => $user];
        } else {
            return ['status' => 'error', 'message' => 'Invalid username or password'];
        }
    }
  

    // public function behaviors()
    // {
      
    //     $behaviors = parent::behaviors();
    //     $behaviors['authenticator']=[
    //         //    'class'=>\yii\filters\auth\HttpBearerAuth::class
    //               'class'=>\yii\filters\auth\QueryParamAuth::class,
    //               'tokenParam'=>'API_KEY'
    //     ];

    //        return $behaviors;



    // }


   
}
