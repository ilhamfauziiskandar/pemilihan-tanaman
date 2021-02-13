	<?php if (!empty(session()->getFlashdata('success'))) { ?>
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <?= session()->getFlashdata('success'); ?>
    </div>
  <?php }?>

    <?php if (!empty(session()->getFlashdata('warning'))) { ?>
    <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <?= session()->getFlashdata('warning'); ?>
    </div>
  <?php }?>

   <div class="form-group">
	 	<h1>Ranking</h1>
	 </div>
	 <hr>
	 <div class="form-group">
	 	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">COBA UJI PARAMETER</button>	
	 </div>

   <table class="table table-hover text-nowrap">
      <thead>                  
        <tr>
          <th width="50px">No</th>
          <th>History</th>
          <th width="200px">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $no = 1;
        foreach ($get_nilai_parameter as $key => $data) {
        ?>
        
        <tr>
          <td>
            <a href="<?= base_url('kriteria') ?>" style="color: black;">
              <?= $no++?>    
            </a>
          </td>
          <td>
            <a href="<?= base_url('ranking/dataranking/'.$data['id_nilai']) ?>" style="color: black;">
              <?= date('d-m-Y', strtotime($data['tanggal'])); ?> &nbsp| 
              &nbsp <?= $data['suhu_param']; ?> C &nbsp |
              &nbsp <?= $data['tekanan_param']; ?> mb &nbsp |
              &nbsp <?= $data['kecepatan_param']; ?> km/jam &nbsp |
              &nbsp <?= $data['curah_param']; ?> mm/bulan &nbsp |
              &nbsp <?= $data['ketinggian_param']; ?> mdpl &nbsp |
              &nbsp <?= $data['kelembaban_param']; ?> % &nbsp |
            </a>
          </td>
          <td>
          <a class="btn btn-info" href="<?= base_url('ranking/dataranking/'.$data['id_nilai']) ?>"">Info</a> 
          <a class="btn btn-danger" onclick="return confirm('Klik ok untuk menghapus data')" href="<?= base_url('ranking/delete_data_nilai/'.$data['id_nilai']) ?>">Delete</a>
          </td>
        </tr>
        <?php }?>
        
      </tbody>
    </table>
    <br>
    <hr>
        <!-- modal uji parameter -->
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Masukan Parameter</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form role="form" action="<?= base_url('ranking/tambah_data_nilai') ?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <input type="text" name="tanggal" value="<?php echo date('Y-m-d'); ?>" hidden>
                    <label for="exampleInputEmail1">(1) Suhu</label>
                    <input type="text" name="suhu" class="form-control" placeholder="C" required="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">(2) Tekanan Udara</label>
                    <input type="text" name="tekanan_udara" class="form-control" placeholder="mb" required="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">(3) Kecepatan Angin</label>
                    <input type="text" name="kecepatan_angin" class="form-control" placeholder="km/jam" required="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">(4) Kelembaban Udara</label>
                    <input type="text" name="kelembaban_udara" class="form-control" placeholder="%" required="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">(5) Curah Hujan</label>
                    <input type="text" name="curah_hujan" class="form-control" placeholder="mm/bulan" required="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">(6) Ketinggian Tempat</label>
                    <input type="text" name="ketinggian_tempat" class="form-control" placeholder="mdpl" required="">
                  </div>
                <!-- /.card-body -->
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--./modal uji parameter-->

