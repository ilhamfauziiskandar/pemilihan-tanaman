<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title> <?= $title ?> | Pemilihan Tanaman</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="shortcut icon" type="image/png" href="<?= base_url('/leaf.png')?>"/>
</head>
<body class="hold-transition sidebar-collapse layout-top-nav">
<div class="wrapper">
<?php 
  foreach ($iklim as $key => $value) {
    $n = count($iklim);
}

$bobot = array(-0.43,8.18,4.15,0.05,-10.39,10.64);
 
$w = array_sum($bobot);

foreach ($tanaman as $key => $data) {

  $data['suhu_param'] = $parameter['suhu_param'] - $data['suhu_tnm'];
  
  if ($data['suhu_param']) {
    $data['suhu_param'] = 5;
  }elseif ($data['suhu_param'] <= 1.99) {
    $data['suhu_param'] = 4;
  }elseif ($data['suhu_param'] <= 2.99) {
    $data['suhu_param'] = 3;
  }elseif ($data['suhu_param']<= 3.99) {
    $data['suhu_param'] = 2;
  }elseif ($data['suhu_param'] >= 4.00) {
    $data['suhu_param'] = 1;
  }

  $data['tekanan_param'] = $parameter['tekanan_param'] - round($avg_tekanan->tekanan_udara,2);
  
  if ($data['tekanan_param'] <= 0.4) {
    $data['tekanan_param'] = 5;
  }elseif ($data['tekanan_param'] <= 0.8) {
    $data['tekanan_param'] = 4;
  }elseif ($data['tekanan_param'] <= 0.12) {
    $data['tekanan_param'] = 3;
  }elseif ($data['tekanan_param'] <= 0.16) {
    $data['tekanan_param'] = 2;
  }elseif ($data['tekanan_param'] >= 0.17) {
    $data['tekanan_param'] = 1;
  }

  $data['kecepatan_param'] = $parameter['kecepatan_param'] - round($avg_kecepatan->kecepatan_angin,2);
  
  if ($data['kecepatan_param'] <= 2) {
    $data['kecepatan_param'] = 5;
  }elseif ($data['kecepatan_param'] <= 4) {
    $data['kecepatan_param'] = 4;
  }elseif ($data['kecepatan_param'] <= 6) {
    $data['kecepatan_param'] = 3;
  }elseif ($data['kecepatan_param'] <= 8) {
    $data['kecepatan_param'] = 2;
  }elseif ($data['kecepatan_param'] >= 9) {
    $data['kecepatan_param'] = 1;
  }

  $data['kelembaban_param'] = $parameter['kelembaban_param'] - $data['kelembaban_tnm'];

  if ($data['kelembaban_param'] <= 5) {
    $data['kelembaban_param'] = 5;
  }elseif ($data['kelembaban_param'] <= 10) {
    $data['kelembaban_param'] = 4;
  }elseif ($data['kelembaban_param'] <= 15) {
    $data['kelembaban_param'] = 3;
  }elseif ($data['kelembaban_param'] <= 20) {
    $data['kelembaban_param'] = 2;
  }elseif ($data['kelembaban_param'] >= 21) {
    $data['kelembaban_param'] = 1;
  }

  $data['curah_param'] = $parameter['curah_param'] - $data['curah_tnm'];
  
  if ($data['curah_param'] <= 29) {
    $data['curah_param'] = 5;
  }elseif ($data['curah_param'] <= 59) {
    $data['curah_param'] = 4;
  }elseif ($data['curah_param'] <= 89) {
    $data['curah_param'] = 3; 
  }elseif ($data['curah_param'] <= 119) {
    $data['curah_param'] = 2;
  }elseif ($data['curah_param'] >= 120) {
    $data['curah_param'] = 1;
  }

  $data['ketinggian_param'] = $parameter['ketinggian_param'] - $data['ketinggian_tnm'];
  
  if ($data['ketinggian_param'] <= 299) {
    $data['ketinggian_param'] = 5;
  }elseif ($data['ketinggian_param'] <= 599) {
    $data['ketinggian_param'] = 4;
  }elseif ($data['ketinggian_param'] <= 899) {
    $data['ketinggian_param'] = 3;
  }elseif ($data['ketinggian_param'] <= 1199) {
    $data['ketinggian_param'] = 2;
  }elseif ($data['ketinggian_param'] >= 1200) {
    $data['ketinggian_param'] = 1;
  }

  $suhu_param[] = $data['suhu_param'];
  $max_suhu = max($suhu_param);
  
  $tekanan_param[] = $data['tekanan_param'];
  $max_tekanan = max($tekanan_param);
  
  $kecepatan_param[] = $data['kecepatan_param'];
  $max_kecepatan = max($kecepatan_param);
  
  $kelembaban_param[] = $data['kelembaban_param'];
  $max_kelembaban = max($kelembaban_param);
  
  $curah_param[] = $data['curah_param'];
  $max_curah = max($curah_param);
  
  $ketinggian_param[] = $data['ketinggian_param'];
  $max_ketinggian = max($ketinggian_param);

  }

  $Normalisasi = 
  array(
    array("Padi",$suhu_param[0],$tekanan_param[0],$kecepatan_param[0],$kelembaban_param[0],$curah_param[0],$ketinggian_param[0]),
    array("Jagung",$suhu_param[1],$tekanan_param[1],$kecepatan_param[1],$kelembaban_param[1],$curah_param[1],$ketinggian_param[1]),
    array("Kedelai",$suhu_param[2],$tekanan_param[2],$kecepatan_param[2],$kelembaban_param[2],$curah_param[2],$ketinggian_param[2]),
    array("Ubi Jalar",$suhu_param[3],$tekanan_param[3],$kecepatan_param[3],$kelembaban_param[3],$curah_param[3],$ketinggian_param[3]),
    array("Ubi Kayu",$suhu_param[4],$tekanan_param[4],$kecepatan_param[4],$kelembaban_param[4],$curah_param[4],$ketinggian_param[4])
  );

  for ($i=0; $i <5 ; $i++) { 
    
    $suhu[$i] = $suhu_param[$i] / $max_suhu;

    $tekanan[$i] = $tekanan_param[$i] / $max_tekanan;
    
    $kecepatan[$i] = $kecepatan_param[$i] / $max_kecepatan;

    $kelembaban[$i] = $kelembaban_param[$i] / $max_kelembaban;

    $curah[$i] = $curah_param[$i] / $max_curah;

    $ketinggian[$i] = $ketinggian_param[$i] / $max_ketinggian; 

  }


  for ($i=0; $i < 5 ; $i++) { 
    
    $v[$i] = ($suhu[$i] * $bobot[0]) + ($tekanan[$i] * $bobot[1]) + ($kecepatan[$i] * $bobot[2]) + ($kelembaban[$i] * $bobot[3]) + ($curah[$i] * $bobot[4]) + ($ketinggian[$i] * $bobot[5]); 

  
  }

  $hasil = 
  array(
    array("Padi",$suhu[0],$tekanan[0],$kecepatan[0],$kelembaban[0],$curah[0],$ketinggian[0],$v[0]),
    array("Jagung",$suhu[1],$tekanan[1],$kecepatan[1],$kelembaban[1],$curah[1],$ketinggian[1],$v[1]),
    array("Kedelai",$suhu[2],$tekanan[2],$kecepatan[2],$kelembaban[2],$curah[2],$ketinggian[2],$v[2]),
    array("Ubi Jalar",$suhu[3],$tekanan[3],$kecepatan[3],$kelembaban[3],$curah[3],$ketinggian[3],$v[3]),
    array("Ubi Kayu",$suhu[4],$tekanan[4],$kecepatan[4],$kelembaban[4],$curah[4],$ketinggian[4],$v[4])
  );

  for ($i=0; $i <6 ; $i++) { 
    
    $nilai_bobot[$i] = $bobot[$i] / $w;
    
  }

  $chart = array(round($v[0],2),round($v[1],2),round($v[2],2),round($v[3],2),round($v[4],2));

  $vv =array($v[0],$v[1],$v[2],$v[3],$v[4]);

  rsort($vv);

  for ($i=0; $i <5 ; $i++) { 
    for ($a=0; $a <5 ; $a++) { 
      if ($hasil[$a][7] == $vv[$i]) {
        $hasil[$a][8] = $i+1;
      }
    }
  }
        
?>

<div class="content">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-body">
<Br />
   <div class="form-group">
    <h1 class="text-center">Data Ranking</h1>
   </div>
   <div class="form-group">
   <div class="row mt-3">
      <div class="col">
<!-- Donut chart -->
        <canvas id="donutChart" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
        <br>
      </div>

   </div>
<form id="cetak">
   <div class="form-group">
      <h4>Nilai Masukan</h4>
   </div>
   <table class="table table-bordered text-center">
      <thead>                  
        <tr>
          <th>Suhu</th>
          <th>Tekanan Udara</th>
          <th>Kecepatan Angin</th>
          <th>Kelembaban Udara</th>
          <th>Curah Hujan</th>
          <th>Ketinggian Tempat</th>
        </tr>
      </thead>
      <tbody>
        
        <tr>
          <td><?= $parameter['suhu_param'] ?> C</td>
          <td><?= $parameter['tekanan_param'] ?> mb</td>
          <td><?= $parameter['kecepatan_param'] ?> km/jam</td>
          <td><?= $parameter['kelembaban_param'] ?> %</td>
          <td><?= $parameter['curah_param'] ?> mm/bulan</td>
          <td><?= $parameter['ketinggian_param'] ?> mdpl</td>
        </tr>
      </tbody>
    </table>

    <div class="form-group">
      <h4>Normalisasi R</h4>
   </div>
   <table class="table table-bordered text-center">
      <thead>  
        <tr>
          <th colspan="7">Kriteria</th>
        </tr>                
        <tr>
          <th>Alternatif</th>
          <th>Suhu</th>
          <th>Tekanan Udara</th>
          <th>Kecepatan Angin</th>
          <th>Kelembaan Udara</th>
          <th>Curah Hujan</th>
          <th>Ketinggian Tempat</th>
        </tr>
        <?php 
        $no = 1;
        foreach ($tanaman as $key => $value) {
          $value['suhu_param'] = $parameter['suhu_param'] - $value['suhu_tnm'];
          
          if ($value['suhu_param']) {
            $value['suhu_param'] = 5;
          }elseif ($value['suhu_param'] <= 1.99) {
            $value['suhu_param'] = 4;
          }elseif ($value['suhu_param'] <= 2.99) {
            $value['suhu_param'] = 3;
          }elseif ($value['suhu_param']<= 3.99) {
            $value['suhu_param'] = 2;
          }elseif ($value['suhu_param'] >= 4.00) {
            $value['suhu_param'] = 1;
          }

          $value['tekanan_param'] = $parameter['tekanan_param'] - round($avg_tekanan->tekanan_udara,2);
          
          if ($value['tekanan_param'] <= 0.4) {
            $value['tekanan_param'] = 5;
          }elseif ($value['tekanan_param'] <= 0.8) {
            $value['tekanan_param'] = 4;
          }elseif ($value['tekanan_param'] <= 0.12) {
            $value['tekanan_param'] = 3;
          }elseif ($value['tekanan_param'] <= 0.16) {
            $value['tekanan_param'] = 2;
          }elseif ($value['tekanan_param'] >= 0.17) {
            $value['tekanan_param'] = 1;
          }

          $value['kecepatan_param'] = $parameter['kecepatan_param'] - round($avg_kecepatan->kecepatan_angin,2);
          
          if ($value['kecepatan_param'] <= 2) {
            $value['kecepatan_param'] = 5;
          }elseif ($value['kecepatan_param'] <= 4) {
            $value['kecepatan_param'] = 4;
          }elseif ($value['kecepatan_param'] <= 6) {
            $value['kecepatan_param'] = 3;
          }elseif ($value['kecepatan_param'] <= 8) {
            $value['kecepatan_param'] = 2;
          }elseif ($value['kecepatan_param'] >= 9) {
            $value['kecepatan_param'] = 1;
          }

          $value['kelembaban_param'] = $parameter['kelembaban_param'] - $value['kelembaban_tnm'];

          if ($value['kelembaban_param'] <= 5) {
            $value['kelembaban_param'] = 5;
          }elseif ($value['kelembaban_param'] <= 10) {
            $value['kelembaban_param'] = 4;
          }elseif ($value['kelembaban_param'] <= 15) {
            $value['kelembaban_param'] = 3;
          }elseif ($value['kelembaban_param'] <= 20) {
            $value['kelembaban_param'] = 2;
          }elseif ($value['kelembaban_param'] >= 21) {
            $value['kelembaban_param'] = 1;
          }

          $value['curah_param'] = $parameter['curah_param'] - $value['curah_tnm'];
          
          if ($value['curah_param'] <= 29) {
            $value['curah_param'] = 5;
          }elseif ($value['curah_param'] <= 59) {
            $value['curah_param'] = 4;
          }elseif ($value['curah_param'] <= 89) {
            $value['curah_param'] = 3; 
          }elseif ($value['curah_param'] <= 119) {
            $value['curah_param'] = 2;
          }elseif ($value['curah_param'] >= 120) {
            $value['curah_param'] = 1;
          }

          $value['ketinggian_param'] = $parameter['ketinggian_param'] - $value['ketinggian_tnm'];
          
          if ($value['ketinggian_param'] <= 299) {
            $value['ketinggian_param'] = 5;
          }elseif ($value['ketinggian_param'] <= 599) {
            $value['ketinggian_param'] = 4;
          }elseif ($value['ketinggian_param'] <= 899) {
            $value['ketinggian_param'] = 3;
          }elseif ($value['ketinggian_param'] <= 1199) {
            $value['ketinggian_param'] = 2;
          }elseif ($value['ketinggian_param'] >= 1200) {
            $value['ketinggian_param'] = 1;
          }
        ?>
        <tr>
          <td><?= $value['nm_tnm'] ?></td>
          <td><?= $value['suhu_param'] ?></td>

          <td>
            <?= $value['tekanan_param'] ?>
          </td>
          
          <td>
            <?= $value['kecepatan_param']; ?>
          </td>
          
          <td>
            <?= $value['kelembaban_param']; ?>
          </td>
          <td>
            <?= $value['curah_param']; ?>
          </td>

          <td>
            <?= $value['ketinggian_param']; ?> 
          </td>
        </tr>
        <?php }  ?>
      </tbody>
    </table>

    <div class="form-group">
      <h4>Hasil Akhir</h4>
    </div>
    <table class="table table-bordered text-center">
      <thead>        
        <tr>
          <th colspan="9">Kriteria</th>
        </tr>                
        <tr>
          <th>Alternatif</th>
          <th>Suhu</th>
          <th>Tekanan Udara</th>
          <th>Kecepatan Angin</th>
          <th>Kelembaan Udara</th>
          <th>Curah Hujan</th>
          <th>Ketinggian Tempat</th>
          <th>Hasil</th>
          <th>Ranking</th>
        </tr>
        <?php

          foreach ($hasil as $key => $hasil) {
          
        ?>
         <tr>
          <td><?= $hasil[0];?></td>

          <td>
            <?= number_format($hasil[1],2,",",".");?>
          </td>
          
          <td>
            <?= number_format($hasil[2],2,",",".");?>
          </td>
          
          <td>
            <?= number_format($hasil[3],2,",",".");?>
          </td>
          
          <td>
            <?= number_format($hasil[4],2,",",".");?>
          </td>
          <td>
            <?= number_format($hasil[5],2,",",".");?>
          </td>
          <td>
            <?= number_format($hasil[6],2,",",".");?>
          </td>
          <td>
            <?= number_format($hasil[7],4,",",".");?>
          </td>
          <td>
            <?= $hasil[8];?>
          </td>
        </tr>
      <?php } ?>
      <tr>
        <th>Bobot</th>
        <?php 

        

        for ($i=0; $i <6 ; $i++) { 
        ?>
        
        <th><?php echo number_format($bobot[$i],2,",","."); ?></th>
        
        <?php } ?>
        <td colspan="2"></td>
      </tr>
      </table>
</form>
</div>
</div>
<script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>  
<script src="<?= base_url() ?>/plugins/chart.js/Chart.min.js"></script>
<script>
  $(function () {

     //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Padi', 
          'Jagung',
          'Kedelai', 
          'Ubi Jalar', 
          'Ubi Bakar' 
      ],
      datasets: [
        {
          data: <?php echo json_encode($chart);?>,
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions      
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
});
setTimeout(function(){window.print();}, 1500);
setTimeout(function(){window.close();}, 3000);

</script>
<!-- jQuery -->
<script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>
<script src="<?= base_url() ?>/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>/dist/js/demo.js"></script>
</body>
</html>

<script>
  
</script>