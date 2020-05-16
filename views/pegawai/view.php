<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pegawai */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Pegawais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pegawai-view">
    <div class="box box-success">
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
                        <?= Html::img('@web/uploads/foto/'.$model->foto, ['alt' => $model->nama]) ?>
                        <?php 
                            $urlHistory = Url::to(['pegawai-pangkat-golongan/index','id_pegawai'=>$model->id]);

                            echo Html::a('History Pangkat/Golongan', $urlHistory, ['class' => 'btn btn-link']) ;
                        ?>
                        <?php 
                            $urlHistory = Url::to(['pegawai-pendidikan/index','id_pegawai'=>$model->id]);

                            echo Html::a('History Pendidikan', $urlHistory, ['class' => 'btn btn-link']) ;
                        ?>
                    </div>

                </div>
                <div class="col-md-9">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'nip',
                                [                                                  
                                    'label' => 'Pangkat/Golongan',
                                    'value' =>  function ($model) {
                                        $lastPangkat = $model->lastPangkat;
                                        return $lastPangkat["pangkat"]."/".$lastPangkat["golongan"];
                                    },
                                ],
                                [                                                  
                                    'label' => 'Tingkat Pendidikan Terakhir',
                                    'value' =>  function ($model) {
                                        $lastPendidikan = $model->lastPendidikan;
                                        return $lastPendidikan["nama"]." (".$lastPendidikan["nama_short"].")";
                                    },
                                ],
                                'tmt',
                                'nama:ntext',
                                'tempat_lahir',
                                'tanggal_lahir',
                                [
                                    'attribute' => 'agama',
                                    'value' => Yii::$app->helper->getAgama($model->agama),
                                ],
                                [
                                    'attribute' => 'jenis_kelamin',
                                    'value' => Yii::$app->helper->getJenisKelamin($model->jenis_kelamin),
                                ],
                                [
                                    'attribute' => 'nikah',
                                    'value' => Yii::$app->helper->getStatusNikah($model->nikah),
                                ],
                                [
                                    'attribute' => 'status_pegawai',
                                    'value' => Yii::$app->helper->getStatusPegawai($model->status_pegawai),
                                ],
                                'alamat:ntext',
                                'telepon',
                                'email:email',
                            ],
                        ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
