<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PegawaiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pegawai';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pegawai-index">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <div class="box-tools pull-right">
                <?= Html::a('Tambah Pegawai', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'nip',
                    'nama:ntext',
                    'tempat_lahir',
                    'tanggal_lahir',
                    //'agama',
                    //'jenis_kelamin',
                    //'nikah',
                    //'status_pegawai',
                    //'alamat:ntext',
                    //'telepon',
                    //'email:email',
                    //'salt:ntext',
                    //'password:ntext',
                    //'created_date',
                    //'created_by',
                    //'updated_date',
                    //'updated_by',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>        
    </div>
</div>
