<?php

namespace app\controllers;

use Yii;
use app\models\PegawaiPendidikan;
use app\models\PegawaiPendidikanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
/**
 * PegawaiPendidikanController implements the CRUD actions for PegawaiPendidikan model.
 */
class PegawaiPendidikanController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PegawaiPendidikan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $id_pegawai = Yii::$app->request->get('id_pegawai');

        $searchModel = new PegawaiPendidikanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['id_pegawai'=>$id_pegawai]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id_pegawai' => $id_pegawai,
        ]);
    }

    /**
     * Displays a single PegawaiPendidikan model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PegawaiPendidikan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PegawaiPendidikan();

        $id_pegawai = Yii::$app->request->get('id');
        $model->id_pegawai = $id_pegawai;

        $tingkatPendidikan = \app\models\MasterTingkatPendidikan::find()->all();
        $pendidikanArray = ArrayHelper::map($tingkatPendidikan,'id','nama');

        if ($model->load(Yii::$app->request->post())) {

            $scan_ijazah = UploadedFile::getInstance($model,'scan_ijazah');

            if(!is_null($scan_ijazah)){
                $date = date("YmdHis");
                $fileName=$model->id_pegawai.$model->id_tingkat_pendidikan.$date.'.'.$scan_ijazah->extension;
                Yii::$app->params['uploadPath'] = Yii::$app->basePath.'/web/uploads/scan/';
                $pathUpload = Yii::$app->params['uploadPath'].$fileName;
                $scan_ijazah->saveAs($pathUpload);
                $model->scan_ijazah = $fileName;
            }

            $model->created_by = Yii::$app->user->identity->id;
            $model->created_date = date("Y-m-d H:i:s");
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }


        return $this->render('create', [
            'model' => $model,
            'pendidikanArray' => $pendidikanArray,
        ]);
    }

    /**
     * Updates an existing PegawaiPendidikan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $temp_scan = $model->scan_ijazah;

        if ($model->load(Yii::$app->request->post())) {

            $scan_ijazah = UploadedFile::getInstance($model,'scan_ijazah');

            if(!is_null($scan_ijazah)){
                $date = date("YmdHis");
                $fileName=$model->id_pegawai.$model->id_tingkat_pendidikan.$date.'.'.$scan_ijazah->extension;
                Yii::$app->params['uploadPath'] = Yii::$app->basePath.'/web/uploads/scan/';
                $pathUpload = Yii::$app->params['uploadPath'].$fileName;
                $scan_ijazah->saveAs($pathUpload);
                $model->scan_ijazah = $fileName;
            }else{
                $model->scan_ijazah = $temp_scan;
            }

            $model->updated_by = Yii::$app->user->identity->id;
            $model->updated_date = date("Y-m-d H:i:s");
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        $tingkatPendidikan = \app\models\MasterTingkatPendidikan::find()->all();
        $pendidikanArray = ArrayHelper::map($tingkatPendidikan,'id','nama');

        return $this->render('update', [
            'model' => $model,
            'pendidikanArray' => $pendidikanArray,
        ]);
    }

    /**
     * Deletes an existing PegawaiPendidikan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PegawaiPendidikan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PegawaiPendidikan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PegawaiPendidikan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
