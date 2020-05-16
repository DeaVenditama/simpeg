<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PegawaiPendidikan */

$this->title = 'Tambah Riwayat Pendidikan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pegawai-pendidikan-create">

    <div class="box">
    	<div class="box-header with-border">
    		<h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    	</div>
    	<div class="box-body">
    		<?= $this->render('_form', [
		        'model' => $model,
		        'pendidikanArray' => $pendidikanArray,
		    ]) ?>		
    	</div>
    </div>
 
</div>
