<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index'],
                'rules' => [
                    [
                        'actions' => ['logout','index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDashboard()
    {
        //Query Pegawai Menurut TMT
        $queryPegawaiMenurutTmt = "
            SELECT YEAR(tmt) as tahun_masuk,
            (
                SELECT COUNT(s.id)
                FROM pegawai s
                WHERE YEAR(s.tmt) <= YEAR(p.TMT)
            ) as jumlah
            FROM pegawai p
            GROUP BY tahun_masuk
            ORDER BY tahun_masuk DESC LIMIT 10
        ";

        $pegawaiMenurutTmt = Yii::$app->db->createCommand($queryPegawaiMenurutTmt)->queryAll();

        //Query Pegawai Menurut Pendidikan
        $queryPegawaiMenurutPendidikan = "
            SELECT m.nama, COUNT(p.id) AS jumlah FROM pegawai_pendidikan p LEFT JOIN master_tingkat_pendidikan m ON p.id_tingkat_pendidikan = m.id GROUP BY p.id_tingkat_pendidikan
        ";

        $pegawaiMenurutPendidikan = Yii::$app->db->createCommand($queryPegawaiMenurutPendidikan)->queryAll();

        //Query Pegawai Menurut Golongan
        $queryPegawaiMenurutGolongan = "
            SELECT m.golongan AS nama, COUNT(p.id) AS jumlah FROM pegawai_pangkat_golongan p LEFT JOIN master_pangkat_golongan m ON p.id_master_pangkat_golongan = m.id GROUP BY p.id_master_pangkat_golongan
        ";

        $pegawaiMenurutGolongan = Yii::$app->db->createCommand($queryPegawaiMenurutGolongan)->queryAll();

        return $this->render('dashboard',
            [
                'pegawaiMenurutTmt' => $pegawaiMenurutTmt,
                'pegawaiMenurutPendidikan' => $pegawaiMenurutPendidikan,
                'pegawaiMenurutGolongan' => $pegawaiMenurutGolongan
            ]
        );
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
