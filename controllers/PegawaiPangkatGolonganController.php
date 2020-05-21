<?php

namespace app\controllers;

use Yii;
use app\models\PegawaiPangkatGolongan;
use app\models\PegawaiPangkatGolonganSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
/**
 * PegawaiPangkatGolonganController implements the CRUD actions for PegawaiPangkatGolongan model.
 */
class PegawaiPangkatGolonganController extends Controller
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
     * Lists all PegawaiPangkatGolongan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $id_pegawai = Yii::$app->request->get("id_pegawai");

        $searchModel = new PegawaiPangkatGolonganSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['id_pegawai'=>$id_pegawai]);
        $dataProvider->sort->attributes['golongan'] = [ 
            'default' => SORT_DESC
        ]; 

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id_pegawai' => $id_pegawai,
        ]);
    }

    /**
     * Displays a single PegawaiPangkatGolongan model.
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
     * Creates a new PegawaiPangkatGolongan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PegawaiPangkatGolongan();

        if ($model->load(Yii::$app->request->post())) {

            $scan = UploadedFile::getInstance($model,'scan');

            if(!is_null($scan)){
                $date = date("YmdHis");
                $fileName=Yii::$app->user->identity->nip.$date.'.'.$scan->extension;
                Yii::$app->params['uploadPath'] = Yii::$app->basePath.'/web/uploads/scan/';
                $pathUpload = Yii::$app->params['uploadPath'].$fileName;
                $scan->saveAs($pathUpload);
                $model->scan = $fileName;
            }

            $model->created_by = Yii::$app->user->identity->id;
            $model->created_date = date("Y-m-d H:i:s");
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $id_pegawai = Yii::$app->request->get("id");
        $model->id_pegawai = $id_pegawai;

        $pangkatGolongan = \app\models\MasterPangkatGolongan::find()->all();
        $pangkatGolonganArray = ArrayHelper::map($pangkatGolongan,'id','golongan');

        return $this->render('create', [
            'model' => $model,
            'pangkatGolonganArray' => $pangkatGolonganArray,
        ]);
    }

    /**
     * Updates an existing PegawaiPangkatGolongan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $temp_scan = $model->scan;

        if ($model->load(Yii::$app->request->post())) {

            $scan = UploadedFile::getInstance($model,'scan');

            if(!is_null($scan)){
                $date = date("YmdHis");
                $fileName=Yii::$app->user->identity->nip.$date.'.'.$scan->extension;
                Yii::$app->params['uploadPath'] = Yii::$app->basePath.'/web/uploads/scan/';
                $pathUpload = Yii::$app->params['uploadPath'].$fileName;
                $scan->saveAs($pathUpload);
                $model->scan = $fileName;
            }else{
                $model->scan = $temp_scan;
            }
            $model->updated_by = Yii::$app->user->identity->id;
            $model->updated_date = date("Y-m-d H:i:s");
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        $pangkatGolongan = \app\models\MasterPangkatGolongan::find()->all();
        $pangkatGolonganArray = ArrayHelper::map($pangkatGolongan,'id','golongan');

        return $this->render('update', [
            'model' => $model,
            'pangkatGolonganArray' => $pangkatGolonganArray,
        ]);
    }

    /**
     * Deletes an existing PegawaiPangkatGolongan model.
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
     * Finds the PegawaiPangkatGolongan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PegawaiPangkatGolongan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PegawaiPangkatGolongan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
