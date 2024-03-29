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
        
        if ($model->checkedOut($userId)) {
            Yii::$app->session->setFlash('error', 'You have already checked out today and cannot check in again');
        } else {
            if ($model->hasCheckedInToday($userId)) {
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
                    Yii::$app->session->setFlash('error', 'User not found');
                }
            }
        }
    
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
 
    public function actionCheckout()
    {
        $userId = Yii::$app->user->id;
        $model = new Attendance();
        
        if ($model->checkedOut($userId)) {
        
            Yii::$app->session->setFlash('error', 'You have already checked out today Cannot check out again');
        } else {
            $checkinRecord = $model->findLatestCheckin($userId);
    
            if ($checkinRecord !== null) {
          
                $checkoutTime = date('Y-m-d H:i:s');
                $checkinRecord->checkout = $checkoutTime;
    
                if ($checkinRecord->save()) {
                    Yii::$app->session->setFlash('success', 'You have successfully checked out');
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to save the checkout time');
                }
            } else {
      
                Yii::$app->session->setFlash('error', 'No check-in record found for today');
            }
        }
    
       
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public  function actionLunchBreak()
    {
        $userId = Yii::$app->user->id;
    
        $model = new Attendance();
    
  
        $checkedOut = $model->hasCheckedOutToday($userId);
        if ($checkedOut) {
            Yii::$app->session->setFlash('error', 'You have already checked out today and cannot take a lunch break');
            return $this->redirect(['attendance/index']);
        }
    
       
        $attendanceRecord = $model->CheckinRecord($userId);
        if ($attendanceRecord === null) {
            Yii::$app->session->setFlash('error', 'No check-in record found for today');
        } else {
           
            if (!$attendanceRecord->lunchBreakIn) {
                $attendanceRecord->lunchBreakIn = date('Y-m-d H:i:s');
                if ($attendanceRecord->save()) {
                    Yii::$app->session->setFlash('success', 'Lunch break time saved');
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to save lunch break time');
                }
            } else {
                Yii::$app->session->setFlash('error', 'You have already taken a lunch break');
            }
        }
    
        return $this->render('create', [
            'model' => $attendanceRecord,
        ]);
    }
    
    public function actionBreakOut()
    {
        $userId = Yii::$app->user->id;
    
   
        $model = new Attendance();
    
     
        $checkedOut =  $model->hasCheckedOutToday($userId);
        if ($checkedOut) {
            Yii::$app->session->setFlash('error', 'You have already checked out today and cannot take a lunch break');
            return $this->redirect(['attendance/index']); 
        }
    

        $attendanceRecord =   $model->CheckinRecord($userId);
        if (!$attendanceRecord) {            
            Yii::$app->session->setFlash('error', 'No check-in record found for today');

        } elseif (!$attendanceRecord->lunchBreakIn) {

            Yii::$app->session->setFlash('error', 'You have not taken a lunch break');
        } elseif ($attendanceRecord->lunchBreakOut) {
            Yii::$app->session->setFlash('error', 'You have already taken a lunch break out');
        } else {
            $attendanceRecord->lunchBreakOut = date('Y-m-d H:i:s');
            if ($attendanceRecord->save()) {
                Yii::$app->session->setFlash('success', 'Lunch break out time saved');
            } else {
                Yii::$app->session->setFlash('error', 'Failed to save lunch break out');
            }
        }
    
        return $this->render('create', [
            'model' =>   $model,
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
