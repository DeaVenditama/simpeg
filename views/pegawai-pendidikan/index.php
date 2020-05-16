<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PegawaiPendidikanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'History Pendidikan '.\app\models\Pegawai::findOne($id_pegawai)->nama;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pegawai-pendidikan-index">
    
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
                    'tingkatPendidikan.nama',
                    'no_ijazah:ntext',
                    'tahun_lulus',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>

</div>
