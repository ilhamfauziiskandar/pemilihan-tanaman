  <?php $id_user = session()->get('id_user'); ?>
  <div class="form-groups text-center mt-3">
  		<h2>Ranking Pemilihan Tanaman</h2>
    </div>
    <dir class="row mt-3">
    <div class="col text-center" style="margin-right: 35px;">
    <img src="<?= base_url('/lipi.jpeg')?>" alt="Girl in a jacket" width="600" height="350">
    </div>
  </dir>
  <dir class="row mt-3">
    <div class="col text-center" style="margin-right: 35px;">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">COBA UJI PARAMETER</button>
    </div>
  </dir>
  <dir class="row mt-3">
    <div class="col text-center" style="margin-right: 35px;">
        <br/>
    </div>
  </dir>
      

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