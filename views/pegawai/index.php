<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

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
                    'nama:ntext',
                    'nip',
                    'email:email',
                    [
                        'header' => 'Action',
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {pangkat} {pendidikan} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url) {
                                return Html::a('view', $url, ['class'=>'btn btn-primary']);
                            },
                            'pangkat' => function ($url,$model) {
                                $url = Url::to(['pegawai-pangkat-golongan/create','id'=>$model->id]);
                                return Html::a('pangkat', $url, ['class'=>'btn btn-warning']);
                            },
                            'pendidikan' => function ($url,$model) {
                                $url = Url::to(['pegawai-pendidikan/create','id'=>$model->id]);
                                return Html::a('pendidikan', $url, ['class'=>'btn btn-info']);
                            },
                            'update' => function ($url,$model) {
                                return Html::a('update', $url, ['class'=>'btn btn-success']);
                            },
                            'delete' => function ($url,$model) {
                                return Html::a('delete', $url, ['class'=>'btn btn-danger']);
                            } 
                        ],
                    ],
                ],
            ]); ?>
        </div>        
    </div>
</div>
