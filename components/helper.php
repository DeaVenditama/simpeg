<?php
namespace app\components;

use Yii;
use yii\base\Component;

class helper extends Component{
    private $agama = [
        '1' => 'Islam',
        '2' => 'Kristen Protestan',
        '3' => 'Kristen Katolik',
        '4' => 'Hindu',
        '5' => 'Budha',
        '6' => 'Konghucu'
    ];
    private $jenisKelamin = [
        '1' => 'Laki-Laki',
        '2' => 'Perempuan'
    ];
    private $statusPegawai = [
        '1' => 'PNS',
        '2' => 'Kontrak'
    ];
    private $statusNikah = [
        '1' => 'Belum Menikah',
        '2' => 'Menikah',
        '3' => 'Cerai Hidup',
        '4' => 'Cerai Mati'
    ];
    public function listAgama()
    {
        return $this->agama;
    }
    public function listJenisKelamin()
    {
        return $this->jenisKelamin;
    }
    public function listStatusPegawai()
    {
        return $this->statusPegawai;
    }
    public function listStatusNikah()
    {
        return $this->statusNikah;
    }

    public function getAgama($id)
    {
        return $this->agama[$id];
    }

    public function getJenisKelamin($id)
    {
        return $this->jenisKelamin[$id];
    }

    public function getStatusPegawai($id)
    {
        return $this->statusPegawai[$id];
    }

    public function getStatusNikah($id)
    {
        return $this->statusNikah[$id];
    }

}
