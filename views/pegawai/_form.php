<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Pegawai */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pegawai-form">

    <?php $form = ActiveForm::begin([]); ?>

    <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php if($this->context->action->id=='create'): ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
    <?php endif ?>

    <?= $form->field($model, 'telepon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_lahir')->widget(DatePicker::class, [
        'language' => 'id',
        'dateFormat' => 'yyyy-MM-dd',
        'options'=>[
            'class' => 'form-control',
            'style' => [
                'cursor'=>'pointer'
            ]
        ]
    ]) ?>
    
    <?= $form->field($model, 'agama')->dropDownList(
        Yii::$app->helper->listAgama(),
        ['prompt'=>'Pilih Agama']
    ); ?>

    <?= $form->field($model, 'jenis_kelamin')->radioList(
        Yii::$app->helper->listJenisKelamin()
    ); ?>

    <?= $form->field($model, 'nikah')->dropDownList(
        Yii::$app->helper->listStatusNikah(),
        ['prompt'=>'Pilih Status Nikah']);
    ?>

    <?= $form->field($model, 'status_pegawai')->radioList(
        Yii::$app->helper->listStatusPegawai());
    ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

    <div class="form-group text-right">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-lg btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
    $this->registerCss("
        input[type='radio']
        {
            margin-left: 10px;
            margin-right: 5px;
        }"
    );
?>