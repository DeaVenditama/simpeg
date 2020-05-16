<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PegawaiPangkatGolonganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'History Pangkat/Golongan '.\app\models\Pegawai::findOne($id_pegawai)->nama;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pegawai-pangkat-golongan-index">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'masterPangkatGolongan.golongan',
                    'masterPangkatGolongan.pangkat',
                    'tanggal_sk',
                    'no_sk',
                    //'scan:ntext',
                    //'created_by',
                    //'created_date',
                    //'updated_by',
                    //'updated_date',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
