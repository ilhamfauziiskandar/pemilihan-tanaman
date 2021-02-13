<?php if (!empty(session()->getFlashdata('success'))) { ?>
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?= session()->getFlashdata('success'); ?>
  </div>
<?php }?>

   <div class="form-group">
    <h2>Tabel produksi</h2>
   </div>
   <table class="table table-bordered text-center">
      <thead>                  
        <tr>
          <th>Tanaman</th>
          <th>Hasil</th>
          <th>Peringkat</th>
          <th>Nilai Preferensi</th>
          <?php if (session()->get('level') == 1){ ?>
            <th width="200px">Action</th>
          <?php }  ?>
          
        </tr>
      </thead>
      <tbody>
        <?php 
        $peringkat = 1;
        $nilai = 5;
        foreach ($kriteria as $key => $data) {
        ?>
        
        <tr>
          <td><?= $data['nm_tnm']; ?></td>
          <td><?= number_format($data['hasil'],0,',','.'); ?></td>
          <td><?= $data['peringkat'] ; ?></td>
          <td><?= $data['nilai_preferensi']; ?></td>
          <?php if (session()->get('level') == 1){ ?>
          <td>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit-data-produksi<?= $data['id_produksi'] ?>">Edit</button>
          </td>
          <?php }  ?>
        </tr>
        <?php }?>
      </tbody>
    </table>
    <br>
    <hr>
 
    <!-- modal edit tanaman-->
    <?php foreach ($kriteria as $key => $data) { ?>
      <div class="modal fade" id="edit-data-produksi<?= $data['id_produksi']?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Edit Data Produksi <?= $data['nm_tnm']?></h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form role="form" action="<?= base_url('alternatif/edit_data_produksi/'.$data['id_produksi'])?>" method="post">
                <div class="card-body">
                    <input type="input" name="id_produksi" class="form-control" required="" readonly="" value="<?= $data['id_produksi']?>">
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">(1) Tanaman</label>
                    <input type="input" name="bulan" class="form-control" required="" readonly="" value="<?= $data['nm_tnm']?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">(2) Hasil</label>
                    <input type="number" name="hasil" class="form-control" required="" value="<?=$data['hasil'] ?>">
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
  <?php } ?>
