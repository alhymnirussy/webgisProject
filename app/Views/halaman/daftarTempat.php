<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
          <div class="row mb-2 justify-content-center">
              <div class="col-sm-8 justify-content-center d-flex">
                  <h3>Daftar Tempat Ibadah Pontianak</h3>
              </div>
          </div>
        <div class="table-responsive">
            <table class="table text-center" id="tableLokasi" style="width:100%;">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama Tempat</th>
                        <th scope="col">Detail</th>
                        <th scope="col">Go Here!</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach($lokasi as $l): ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $l['nama_tempat']; ?></td>
                            <td><a href="/dasboard/detail/<?= $l['id_lokasi']; ?>" class="btn btn-warning"><i class="bi bi-ticket-detailed-fill"></i></a></td>
                            <td><a href="/dasboard/cariNavigasi/<?= $l['id_lokasi']; ?>" class="btn btn-danger"><i class="fa-solid fa-location-dot"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
      </div><!-- /.container-fluid -->
    </div>
</div>

<script>
     $(document).ready(function(){
            // script untuk datatables
        $('#tableLokasi').DataTable({
            lengthMenu:[[5,10,25,50,-1],[5,10,25,50,"All"]]
        });
    });
</script>

  <?= $this->endSection('content'); ?>