<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Envelope */

$this->title = 'Update Envelope: ' . ' ' . $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Envelopes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="envelope-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
