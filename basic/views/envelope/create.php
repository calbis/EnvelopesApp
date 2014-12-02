<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Envelope */

$this->title = 'Create Envelope';
$this->params['breadcrumbs'][] = ['label' => 'Envelopes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="envelope-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
