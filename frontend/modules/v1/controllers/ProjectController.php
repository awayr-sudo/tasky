<?php

namespace frontend\modules\v1\controllers;



use yii\rest\ActiveController;




/**
 * Default controller for the `v1` module
 */
class ProjectController extends ActiveController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public $modelClass = "common\models\Project";
    
   

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
