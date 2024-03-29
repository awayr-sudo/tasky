<?php

namespace frontend\controllers;

use common\models\attendance;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii;
use yii\filters\AccessControl;
use common\models\User;
/**
 * AttendanceController implements the CRUD actions for attendance model.
 */
class AttendanceController extends Controller
{
    /**
     * @inheritDoc
     */
    // public function behaviors()
    // {
    //     return array_merge(
    //         parent::behaviors(),
    //         [
    //             'verbs' => [
    //                 'class' => VerbFilter::className(),
    //                 'actions' => [
    //                     'delete' => ['POST'],
    //                 ],
    //             ],
    //         ]
    //     );
    // }
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'update', 'create'], 
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create','update','index'], 
                        'roles' => ['@'], 
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'update','delete','index'], 
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }
    /**
     * Lists all attendance models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => attendance::find(),
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

    /**
     * Displays a single attendance model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new attendance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new attendance();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionCheckin()
    {
        $model = new Attendance();
        $userId = Yii::$app->user->id; 
    
      
        $AttendanceRceord = Attendance::find()
            ->where(['user_id' => $userId])
            ->andWhere(['attendance_date' => date('Y-m-d')])
            ->andWhere(['not', ['checkout' => null]])
            ->exists();
    
        if ($AttendanceRceord) {
            Yii::$app->session->setFlash('error', 'You have already checked out today cannot checked in ');
        } else {
          
            $AttendanceRceord = Attendance::find()
                ->where(['user_id' => $userId])
                ->andWhere(['attendance_date' => date('Y-m-d')])
                ->exists();
    
            if ($AttendanceRceord) {
                Yii::$app->session->setFlash('error', 'You have already checked in today');
            } else {
                $user = User::findOne($userId); 
            
                if ($user) {
                    $model->user_id = $userId;
                    $model->name = $user->username; 
                    $model->checkin = date('Y-m-d H:i:s');
                    $model->attendance_date = date('Y-m-d');
            
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Successfully checked in');
                    } else {
                        Yii::$app->session->setFlash('error', 'Failed to check in');
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'User not found.');
                }
            }
        }
    
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCheckout()
{
    $model = new Attendance();
    $userId = Yii::$app->user->id; 

    
    $AttendanceRceord= Attendance::find()
        ->where(['user_id' => $userId])
        ->andWhere(['attendance_date' => date('Y-m-d')])
        ->andWhere(['not', ['checkout' => null]])
        ->exists();

    if ($AttendanceRceord) {
        Yii::$app->session->setFlash('error', 'You have already checked out today ');
    } else {
     
        $AttendanceRceord = Attendance::find()
            ->where(['user_id' => $userId])
            ->andWhere(['attendance_date' => date('Y-m-d')])
            ->andWhere(['not', ['checkin' => null]])
            ->orderBy(['id' => SORT_DESC])
            ->one();

        if (!$AttendanceRceord) {
            Yii::$app->session->setFlash('error', 'You have not checked in yet');
        } else {
           
            $AttendanceRceord->checkout = date('Y-m-d H:i:s');

         
            $checkInTimestamp = strtotime($AttendanceRceord->checkin);
            $checkOutTimestamp = strtotime($AttendanceRceord->checkout);
            $workTimeSeconds = $checkOutTimestamp - $checkInTimestamp;

            $hours = floor($workTimeSeconds / 3600);
            $minutes = floor(($workTimeSeconds % 3600) / 60);
            $seconds = $workTimeSeconds % 60;
            $AttendanceRceord->worktime = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);

            if ($AttendanceRceord->save()) {
                Yii::$app->session->setFlash('success', 'Successfully checked out');
            } else {
                Yii::$app->session->setFlash('error', 'Failed to check out');
            }
        }
    }

    return $this->render('create', [
        'model' => $model,
    ]);
}
    /**
     * Updates an existing attendance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing attendance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the attendance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return attendance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = attendance::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
