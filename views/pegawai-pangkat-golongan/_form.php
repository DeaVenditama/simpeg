<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\jui\DatePicker;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\PegawaiPangkatGolongan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pegawai-pangkat-golongan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        echo $form->field($model, 'id_master_pangkat_golongan')->widget(Select2::classname(), [
                'data' => $pangkatGolonganArray,
                'options' => ['placeholder' => 'Pilih Rule', 'multiple' => false],
            ])->label('Pangkat/Golongan');  
    ?>

    <?= $form->field($model, 'id_pegawai')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'tanggal_sk')->widget(DatePicker::class, [
        'language' => 'id',
        'dateFormat' => 'yyyy-MM-dd',
        'options'=>[
            'class' => 'form-control',
            'style' => [
                'cursor'=>'pointer'
            ]
        ]
    ]) ?>

    <?= $form->field($model, 'no_sk')->textInput(['maxlength' => true]) ?>

    <?php 
        echo $form->field($model, 'scan')->widget(FileInput::classname(), [
            'pluginOptions'=>
            [
                'allowedFileExtensions'=>['jpeg','jpg','png'],
                'showUpload' => false,
                'browseLabel' => '',
                'removeLabel' => '',
                'showPreview' => true,
                'showCaption' => true,
                'showRemove' => true,
            ]
        ]);
    ?>

    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
