<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PegawaiPendidikan */

$this->title = $model->tingkatPendidikan->nama.' '.$model->pegawai->nama;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pegawai-pendidikan-view">

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <div class="box-tools pull-right">
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="text-center">
                        <?= Html::img('@web/uploads/scan/'.$model->scan_ijazah, ['alt' => $model->scan_ijazah,'width'=>'250px']) ?>
                    </div>
                </div>
                <div class="col-md-9">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'tingkatPendidikan.nama',
                            'no_ijazah:ntext',
                            'tahun_lulus',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
