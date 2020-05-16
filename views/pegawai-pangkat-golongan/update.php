<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PegawaiPangkatGolongan */

$this->title = 'Update SK '.$model->masterPangkatGolongan->golongan .' '. $model->pegawai->nama;
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pegawai-pangkat-golongan-update">

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
