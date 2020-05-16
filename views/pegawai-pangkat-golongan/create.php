<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PegawaiPangkatGolongan */

$this->title = 'Input Pangkat Golongan '.\app\models\Pegawai::findOne($model->id_pegawai)->nama;
$this->params['breadcrumbs'][] = ['label' => 'Pegawai Pangkat Golongan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pegawai-pangkat-golongan-create">

    <div class="box">
    	<div class="box-header with-border">
    		<h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    	</div>
    	<div class="box-body">
    		<?= $this->render('_form', [
        		'model' => $model,
        		'pangkatGolonganArray' => $pangkatGolonganArray,
    		]) ?>
    	</div>
    </div>
</div>
