<?php $tahun = date('Y'); ?>

<?php if (!empty(session()->getFlashdata('success'))) { ?>
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?= session()->getFlashdata('success'); ?>
  </div>
<?php } ?>

<?php if (!empty(session()->getFlashdata('warning'))) { ?>
  <div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?= session()->getFlashdata('warning'); ?>
  </div>
<?php } ?>


<div class="form-group">
  <h2>Tabel Aturan</h2>
</div>
<table class="table table-bordered text-center">
  <thead>
    <tr>
      <th>Tanaman</th>
      <th>Suhu</th>
      <th>Tekanan Udara</th>
      <th>Kecepatan Angin</th>
      <th>Kelembaban Udara</th>
      <th>Curah Hujan</th>
      <th>Ketinggian Tempat</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    foreach ($tanaman as $key => $data) {
    ?>
      <tr>
        <td><?= $data['nm_tnm']; ?></td>
        <td><?= $data['suhu_tnm']; ?> c</td>
        <td><?= round($avg_tekanan->tekanan_udara, 2); ?> mb</td>
        <td><?= round($avg_kecepatan->kecepatan_angin, 2); ?> km/jam</td>
        <td><?= $data['kelembaban_tnm']; ?> %</td>
        <td><?= $data['curah_tnm']; ?> mm/bulan</td>
        <td><?= $data['ketinggian_tnm']; ?> mdpl</td>
      </tr>
    <?php } ?>
    </tr>
  </tbody>
</table>
<br>
<hr>
<div class="form-group">
  <h2>Tabel Tanaman</h2>
</div>
<table class="table table-bordered text-center">
  <thead>
    <tr>
      <th style="width: 10px">No</th>
      <th>Tanaman</th>
      <th>Suhu</th>
      <th>kelembaban Udara</th>
      <th>Curah Hujan</th>
      <th>Ketinggian Tempat</th>
      <?php if (session()->get('level') == 1) { ?>
        <th>Action</th>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    foreach ($tanaman as $key => $data) {
    ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $data['nm_tnm']; ?></td>
        <td><?= $data['suhu_tnm']; ?> c</td>
        <td><?= $data['kelembaban_tnm']; ?> %</td>
        <td><?= $data['curah_tnm']; ?> mm/bulan</td>
        <td><?= $data['ketinggian_tnm']; ?> mdpl</td>
        <?php if (session()->get('level') == 1) { ?>
          <td>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-tanaman<?= $data['id_tnm'] ?>">Edit</button>
            <a class="btn btn-danger" onclick="return confirm('Klik ok untuk menghapus data')" href="<?= base_url('kriteria/delete_data_tanaman/' . $data['id_tnm']) ?>">Delete</a>
          </td>
        <?php } ?>
      </tr>
    <?php } ?>
  </tbody>
</table>
<hr>
<br>

<div class="form-group">
  <h2>Tabel Iklim</h2>
</div>

<?php if (session()->get('level') == 1) { ?>
  <div class="form-group">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-iklim">Tambah Data Iklim</button>
  </div>
<?php } ?>

<table class="table table-bordered text-center">
  <thead>
    <tr>
      <th style="width: 10px">No</th>
      <th>Bulan</th>
      <th>Tekanan Udara</th>
      <th>Kecepatan Angin</th>
      <th>Kelembaban Udara</th>
      <?php if (session()->get('level') == 1) { ?>
        <th>Action</th>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    foreach ($iklim as $key => $data) {
    ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= date('M', strtotime($data['date'])); ?></td>
        <td><?= $data['tekanan_udara']; ?> mb</td>
        <td><?= $data['kecepatan_angin']; ?> km/jam</td>
        <td><?= $data['kelembaban_udara']; ?> %</td>
        <?php if (session()->get('level') == 1) { ?>
          <td>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-iklim<?= $data['id_iklim'] ?>">Edit</button>
            <a class="btn btn-danger" onclick="return confirm('Klik ok untuk menghapus data')" href="<?= base_url('kriteria/delete_data_iklim/' . $data['id_iklim']) ?>">Delete</a>
          </td>
        <?php } ?>
      </tr>
    <?php } ?>
    <tr>
      <?php
      foreach ($avg_iklim as $key => $data1) {
      ?>
        <th colspan="2">Rata-rata</th>
        <th><?= $data1['tekanan_udara']; ?> mb</th>
        <th><?= $data1['kecepatan_angin']; ?> km/jam</th>
        <th><?= $data1['kelembaban_udara']; ?> %</th>
      <?php } ?>
      <th></th>
    </tr>
  </tbody>
</table>
<br>

<table class="table table-bordered text-center">
  <thead>
    <tr>
      <th colspan="7">BOBOT</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php
      $file = "jason/bobot.json";
      $getfile = file_get_contents($file);
      $bobot = json_decode($getfile, true);

      for ($i = 0; $i < 6; $i++) {
        # code...
      ?>
        <td><?php echo $bobot[$i]; ?></td>
      <?php } ?>

      <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-bobot">Edit</button>
      </td>
    </tr>
  </tbody>
</table>
<br>
<hr>

<div class="modal fade" id="modal-tambah-iklim">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Tambah Data Iklim</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" action="<?= base_url('kriteria/tambah_data_iklim') ?>" method="post">
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">(1) Bulan</label>
              <input type="" name="tahun" class="form-control" value="<?php echo $tahun; ?>" hidden required="">
              <select name="bulan" class="form-control">
                <option>-- Pilih Bulan --</option>
                <option>Jan</option>
                <option>Feb</option>
                <option>Mar</option>
                <option>Apr</option>
                <option>May</option>
                <option>Jun</option>
                <option>Jul</option>
                <option>Aug</option>
                <option>Sep</option>
                <option>Oct</option>
                <option>Nov</option>
                <option>Dec</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">(2) Tekanan Udara</label>
              <input type="text" name="tekanan_udara" class="form-control" required="" placeholder="mb">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">(3) Kecepatan Angin</label>
              <input type="text" name="kecepatan_angin" class="form-control" required="" placeholder="km/jam">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">(4) Kelembaban Udara</label>
              <input type="text" name="kelembaban_udara" class="form-control" required="" placeholder="%">
            </div>
            <!-- /.card-body -->
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</div>

<!-- modal edit iklim-->
<?php foreach ($iklim as $key => $data) { ?>
  <div class="modal fade" id="modal-edit-iklim<?= $data['id_iklim'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Edit Data Iklim </h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" action="<?= base_url('kriteria/edit_data_iklim/' . $data['id_iklim']) ?>" method="post">
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">(1) Bulan</label>
                <input type="input" readonly name="date" class="form-control" required="" value="<?= date('M', strtotime($data['date'])); ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">(2) Tekanan Udara</label>
                <input type="text" name="tekanan_udara" class="form-control" required="" value="<?= $data['tekanan_udara'] ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">(3) Kecepatan Angin</label>
                <input type="text" name="kecepatan_angin" class="form-control" required="" value="<?= $data['kecepatan_angin'] ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">(4) Kelembaban Udara</label>
                <input type="text" name="kelembaban_udara" class="form-control" required="" value="<?= $data['kelembaban_udara'] ?>">
              </div>
              <!-- /.card-body -->
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  </div>
  <!-- /modal edit iklim-->
<?php } ?>

<!-- modal edit tanaman-->
<?php foreach ($tanaman as $key => $data) { ?>
  <div class="modal fade" id="modal-edit-tanaman<?= $data['id_tnm'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Edit Data Tanaman <?= $data['nm_tnm'] ?></h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" action="<?= base_url('kriteria/edit_data_tanaman/' . $data['id_tnm']) ?>" method="post">
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">(1) Tanaman</label>
                <input type="text" name="nm_tnm" class="form-control" required="" readonly="" value="<?= $data['nm_tnm'] ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">(2) Suhu</label>
                <input type="text" name="suhu_tnm" class="form-control" required="" value="<?= $data['suhu_tnm'] ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">(3) Kelembaban Udara</label>
                <input type="text" name="kelembaban_tnm" class="form-control" required="" value="<?= $data['kelembaban_tnm'] ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">(4) Curah Hujan</label>
                <input type="text" name="curah_tnm" class="form-control" required="" value="<?= $data['curah_tnm'] ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">(5) Ketinggian Tempat</label>
                <input type="text" name="ketinggian_tnm" class="form-control" required="" value="<?= $data['ketinggian_tnm'] ?>">
              </div>
              <!-- /.card-body -->
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  </div>
  <!-- /modal edit tanaman-->
<?php } ?>

<!-- modal edit bobot-->
<?php

$file = "jason/bobot.json";
$getfile = file_get_contents($file);
$bobot = json_decode($getfile, true);

?>
<div class="modal fade" id="modal-edit-bobot">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Edit Data Bobot</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" action="<?= base_url('kriteria/edit_data_bobot/') ?>" method="post">
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">(1)</label>
              <input type="text" name="ji" class="form-control" required="" value="<?= $bobot[0] ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">(2)</label>
              <input type="text" name="wa" class="form-control" required="" value="<?= $bobot[1] ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">(3)</label>
              <input type="text" name="lu" class="form-control" required="" value="<?= $bobot[2] ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">(4)</label>
              <input type="text" name="pat" class="form-control" required="" value="<?= $bobot[3] ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">(5)</label>
              <input type="text" name="ma" class="form-control" required="" value="<?= $bobot[4] ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">(6)</label>
              <input type="text" name="nam" class="form-control" required="" value="<?= $bobot[5] ?>">
            </div>
            <!-- /.card-body -->
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</div>
<!-- /modal edit bobot-->