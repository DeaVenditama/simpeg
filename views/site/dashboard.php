<?php

use dosamigos\chartjs\ChartJs;

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;

$labelTahun = [];
$dataJumlah = [];

foreach($pegawaiMenurutTmt as $pegawai){
	array_push($labelTahun, $pegawai["tahun_masuk"]);
	array_push($dataJumlah, $pegawai["jumlah"]);
}

$labelTahun = array_reverse($labelTahun);
$dataJumlah = array_reverse($dataJumlah);


$labelPendidikan = [];
$dataPendidikan = [];

foreach($pegawaiMenurutPendidikan as $pegawai){
	array_push($labelPendidikan, $pegawai["nama"]);
	array_push($dataPendidikan, $pegawai["jumlah"]);
}

$labelGolongan = [];
$dataGolongan = [];

foreach($pegawaiMenurutGolongan as $pegawai){
	array_push($labelGolongan, $pegawai["nama"]);
	array_push($dataGolongan, $pegawai["jumlah"]);
}

?>


<div class="box box-danger">
	<div class="header with-border">
		<h3 class="box-title">Dashboard</h3>
	</div>
	<div class="box-body">
		<?= ChartJs::widget([
		    'type' => 'line',
		    'options' => [
		        'height' => 100,
		    ],
		    'data' => [
		        'labels' => $labelTahun,
		        'datasets' => [
		            [
		                'label' => "Jumlah Pegawai",
		                'backgroundColor' => "rgba(192, 57, 43,0.8)",
		                'borderColor' => "rgba(192, 57, 43,1.0)",
		                'data' => $dataJumlah
		            ],
		        ]
		    ]
		]);
		?>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="box box-danger">
			<div class="box-body">
				<?= ChartJs::widget([
				    'type' => 'pie',
				    'options' => [
				        'height' => 200,
				    ],
				    'data' => [
				        'labels' => $labelPendidikan,
				        'datasets' => [
				            [
				                'label' => "Jumlah Pegawai",
				                'backgroundColor' => [
				                	'rgba(231, 76, 60,1.0)',
				                	'blue',
				                	'rgba(52, 152, 219,1.0)',
				                	'rgba(241, 196, 15,1.0)'
				                ],
				                'data' => $dataPendidikan
				            ],
				        ]
				    ]
				]);
				?>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="box box-danger">
			<div class="box-body">
				<?= ChartJs::widget([
				    'type' => 'bar',
				    'options' => [
				        'height' => 200,
				    ],
				    'data' => [
				        'labels' => $labelGolongan,
				        'datasets' => [
				            [
				                'label' => "Jumlah Pegawai",
				                'backgroundColor' => 'rgba(231, 76, 60,1.0)',
				                'data' => $dataGolongan
				            ],
				        ]
				    ]
				]);
				?>
			</div>
		</div>
	</div>
</div>