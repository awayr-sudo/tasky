<?php

use common\models\Tablelists;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Table List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tablelists-index">
       
<h1 style="text-align: center;">Task List</h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'name',
                'label' => 'Task',
            ],
            'description:ntext',
            // 'created_by',
            [
                'attribute' => 'created_by',
                'value' => function ($model) {
                    return $model->createdBy->username;
                },
            ],
            'status',
            'updated_at',
        [
            'class' => ActionColumn::className(),
            'template' => '{complete} {view} {update} {delete}', 
            'buttons' => [
                'complete' => function ($url, $model, $key) {
                    return Html::a('Complete', ['complete', 'id' => $model->id], [
                        'class' => 'btn btn-primary btn-xs',
                        'data' => [
                            'confirm' => 'Are you sure you want to mark this task as completed?',
                            'method' => 'post',
                        ],
                    ]);
                },
            ],
        ],
    ],
]); ?>

</div>
