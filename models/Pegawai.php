<?php
namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "pegawai".
 *
 * @property int $id
 * @property string $nip
 * @property string $nama
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property int $agama
 * @property int $jenis_kelamin
 * @property int $nikah
 * @property int $status_pegawai
 * @property string $alamat
 * @property string $telepon
 * @property string $email
 * @property string $salt
 * @property string $password
 * @property string $created_date
 * @property int $created_by
 * @property string|null $updated_date
 * @property int|null $updated_by
 */
class Pegawai extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pegawai';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [[['nip', 'nama', 'tempat_lahir', 'tanggal_lahir', 'agama', 'jenis_kelamin', 'nikah', 'status_pegawai', 'alamat', 'telepon', 'email', 'created_date', 'created_by'], 'required'], [['nama', 'alamat', 'salt', 'password'], 'string'], [['tanggal_lahir', 'created_date', 'updated_date', 'tmt'], 'safe'], [['agama', 'jenis_kelamin', 'nikah', 'status_pegawai', 'created_by', 'updated_by'], 'integer'], [['nip', 'tempat_lahir', 'email'], 'string', 'max' => 32], [['telepon'], 'string', 'max' => 15], ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return ['id' => 'ID', 'nip' => 'Nip', 'nama' => 'Nama', 'tempat_lahir' => 'Tempat Lahir', 'tanggal_lahir' => 'Tanggal Lahir', 'tmt' => 'Terhitung Mulai Tugas', 'agama' => 'Agama', 'jenis_kelamin' => 'Jenis Kelamin', 'nikah' => 'Nikah', 'status_pegawai' => 'Status Pegawai', 'alamat' => 'Alamat', 'telepon' => 'Telepon', 'email' => 'Email', 'salt' => 'Salt', 'password' => 'Password', 'created_date' => 'Created Date', 'created_by' => 'Created By', 'updated_date' => 'Updated Date', 'updated_by' => 'Updated By', ];
    }

    public static function hashPassword($salt, $password)
    { // Function to create password hash
        return md5($salt . $password);
    }
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) return false;
        if ($insert)
        {
            $password = $this->password;
            $salt = $this->generateSalt();
            $this->salt = $salt;
            $this->password = $this->hashPassword($salt, $password);
        }
        return true;

    }

    protected function generateSalt()
    {
        return uniqid('', true);
    }

    public function validatePassword($password)
    {
        return $this->password === static ::hashPassword($this->salt, $password);;
    }
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $user = self::find()->where(["id" => $id])->one();
        if (is_null($user))
        {
            return null;
        }
        return new static ($user);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $userType = null)
    {

        $user = self::find()->where(["accessToken" => $token])->one();
        if (!count($user))
        {
            return null;
        }
        return new static ($user);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $user = self::find()->where(["username" => $username])->one();
        if (is_null($user))
        {
            return null;
        }
        return new static ($user);
    }
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */

    public function getAuthKey()
    {
        return $this->salt;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function getPegawaiPangkatGolongans()
    {
        return $this->hasMany(PegawaiPangkatGolongan::className() , ['id_pegawai' => 'id']);
    }

    public function getLastPangkat()
    {
        $query = "SELECT t.id_master_pangkat_golongan,m.pangkat, m.golongan FROM pegawai_pangkat_golongan t INNER JOIN master_pangkat_golongan m ON t.id_master_pangkat_golongan = m.id WHERE t.id_pegawai=:id_pegawai ORDER BY t.id DESC LIMIT 1";
        $last = Yii::$app->db->createCommand($query)->bindValue("id_pegawai",$this->id)->queryOne();
        return $last; 
    }

    public function getPegawaiPendidikan()
    {
        return $this->hasMany(PegawaiPendidikan::className() , ['id_pegawai' => 'id']);
    }

    public function getLastpendidikan()
    {
        $query = "SELECT t.id_tingkat_pendidikan,m.nama, m.nama_short FROM pegawai_pendidikan t INNER JOIN master_tingkat_pendidikan m ON t.id_tingkat_pendidikan = m.id WHERE t.id_pegawai=:id_pegawai ORDER BY m.id DESC LIMIT 1";
        $last = Yii::$app->db->createCommand($query)->bindValue("id_pegawai",$this->id)->queryOne();
        return $last; 
    }

}

