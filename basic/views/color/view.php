<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Color */

$this->title = $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Colors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="color-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'Id' => $model->Id, 'Name' => $model->Name], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'Id' => $model->Id, 'Name' => $model->Name], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id',
            'Name',
        ],
    ]) ?>

</div>
