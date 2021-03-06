<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transactions';
?>
<div class="transaction-index">
    <?php
    $actionCol = [
        'class' => 'yii\grid\ActionColumn',
        'template' => '{view}{update}{delete}{pending}{info}',
        'buttons' =>
        [
            'view' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Yii::t('yii', 'View'),
                            'class' => 'showDialog gridActions hiddenGridActions'
                ]);
            },
                    'update' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('yii', 'Update'),
                            'class' => 'showDialog gridActions hiddenGridActions'
                ]);
            },
                    'delete' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                            'data-method' => 'post',
                            'class' => 'gridActions hiddenGridActions'
                ]);
            },
                    'pending' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-arrow-left"></span>', $url, [
                            'title' => Yii::t('app', 'Pending'),
                            'class' => 'gridActions hiddenGridActions'
                ]);
            },
                    'info' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-cog"></span>', $url, [
                            'title' => Yii::t('app', 'Info'),
                            'class' => 'gridActionsExpand'
                ]);
            }
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
            if ($action === 'view') {
                $url = yii\helpers\Url::to(['transaction/view', 'id' => $model->Id]);
                return $url;
            } elseif ($action === 'update') {
                $url = yii\helpers\Url::to(['transaction/update', 'id' => $model->Id]);
                return $url;
            } elseif ($action === 'delete') {
                $url = yii\helpers\Url::to(['transaction/delete', 'id' => $model->Id]);
                return $url;
            } elseif ($action === 'pending') {
                $url = yii\helpers\Url::to(['transaction/move-pending', 'id' => $model->Id, 'postBack' => 'envelope']);
                return $url;
            }
        }
            ];
            ?>

            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'containerOptions' => ['class' => 'divAccountTransactions'],
                'columns' => //$gridColumns,
                [
                    ['class' => '\kartik\grid\SerialColumn', 'visible' => false],
                    ['attribute' => 'PostedDate', 'width' => '90px'],
                    ['attribute' => 'Name',
                        'content' => function ($model) {
                            $icons = ($model->UseInStats === 1 ? "<span class=\"glyphicon glyphicon-signal\"></span> " : "");
                            $icons = $icons . ($model->IsRefund === 1 ? "<span class=\"glyphicon glyphicon-certificate\"></span> " : "");
                            return $icons . $model->Name;
                        }],
                    ['attribute' => 'Amount', 'width' => '80px',
                        'content' => function ($model) {
                            if ($model->Amount !== null && $model->Amount != 0) {
                                $url = $model->Amount;
                                return $url;
                            }
                            return "";
                        }],
                    ['attribute' => 'Pending', 'width' => '80px',
                        'content' => function ($model) {
                            if ($model->Pending !== null && $model->Pending != 0) {
                                return Html::a($model->Pending, ['transaction/move-pending', 'id' => $model->Id, 'postBack' => 'envelope'], ['class' => 'showDialog ' . $model->envelope->Color, 'title' => 'Transfer Funds']);
                            }
                            return "";
                        }],
//                    ['attribute' => 'UseInStats', 'class' => '\kartik\grid\BooleanColumn'],
//                    ['attribute' => 'IsRefund', 'class' => '\kartik\grid\BooleanColumn'],
                            $actionCol,
                        ],
                        'responsive' => true,
                        'hover' => true,
                        'condensed' => true,
                        'export' => false,
                        'bootstrap' => true,
                        'rowOptions' => function ($model, $index, $widget, $grid) {
                    return ['class' => $model->envelope->Color . ' trStats' . $model->UseInStats . ' trRefund' . $model->IsRefund];
                }
                    ]);
                    ?>
</div>
