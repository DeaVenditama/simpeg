<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\jui\DatePicker;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\PegawaiPendidikan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pegawai-pendidikan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_pegawai')->hiddenInput()->label(false) ?>

    <?php
        echo $form->field($model, 'id_tingkat_pendidikan')->widget(Select2::classname(), [
                'data' => $pendidikanArray,
                'options' => ['placeholder' => 'Pilih Tingkat Pendidikan', 'multiple' => false],
            ])->label('Tingkat Pendidikan');  
    ?>

    <?= $form->field($model, 'no_ijazah')->textInput() ?>

    <?php 
        echo $form->field($model, 'scan_ijazah')->widget(FileInput::classname(), [
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

    <?= $form->field($model, 'tahun_lulus')->textInput(['maxlength' => true,'type'=>'number']) ?>

    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
