<?php

namespace frontend\controllers;

use common\models\Tablelists;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;


/**
 * Table_listsController implements the CRUD actions for Tablelists model.
 */
class Table_listsController extends Controller
{
    /**
     * @inheritDoc
     */
    // public function behaviors()
    // {
    //     return array_merge(
    //         parent::behaviors(),
    //         [
    //             'access' => [
    //                 'class' => AccessControl::className(),
    //                 'only' => ['create'],
    //                 'rules' => [
    //                     [
    //                         'allow' => true,
    //                         'roles' => ['@'],
    //                     ],
    //                 ],
    //             ],
    //         ],
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
                'class' => \yii\filters\AccessControl::class,
                'only' => ['create', 'update', 'delete','index'], 
                'rules' => [
                    [
                        'allow' => true,
                        'actions'=>['index','update','create',], 
                        'roles' => ['@'], 
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'update', 'delete','index'],
                        'roles' => ['admin'], 
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Tablelists models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tablelists::find(),
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
     * Displays a single Tablelists model.
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
     * Creates a new Tablelists model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tablelists();

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

    /**
     * Updates an existing Tablelists model.
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

    public function actionComplete($id)
    {
        $model = $this->findModel($id);

        if ($model->status === 'completed') {
            Yii::$app->session->setFlash('warning', 'You have already completed this task');
            return $this->redirect(['index']);
        }
       
        $model->status = 'completed';

        $model->updated_at = date('Y-m-d H:i:s');
        
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Task marked as completed successfully');
        } else {
            Yii::$app->session->setFlash('error', 'Failed to mark task as completed');
        }

        return $this->redirect(['index']);
    }
    /**
     * Deletes an existing Tablelists model.
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
     * Finds the Tablelists model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Tablelists the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tablelists::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
