<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
         <!-- Small boxes (Stat box) -->
        <button onclick="goBack()" class="btn btn-info"><i class="bi bi-arrow-return-left"></i></button>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="mb-2">Detail Lokasi </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="card">
          <div class="row g-0">
            <div class="col-md-6">
              <img src="/assets/gambarLokasi/images-location/<?= $lokasi['gambar']; ?>" class="img-fluid rounded-start" alt="..." style="height:100%;">
            </div>
            <div class="col-md-6">
              <div class="card-body">
                <h3 class="text-bold"><?= $lokasi['nama_tempat']; ?></h3><br>
                <h5 class="card-title">Jenis Tempat : <?= $lokasi['jenis']; ?></h5><br><br>
                <h5 class="card-title">Kota : <?= $lokasi['kota']; ?></h5><br><br>
                <h5 class="card-title">Kecamatan : <?= $lokasi['kecamatan']; ?></h5><br><br>
                <h5 class="card-title">Latitude : <?= $lokasi['latitude']; ?></h5><br><br>
                <h5 class="card-title">Longitude : <?= $lokasi['longitude']; ?></h5><br><br>
                <a href="/dasboard/home" class="btn btn-warning mt-4">Kembali</a>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
      <div id="map" style="height: 450px; width:100%;"></div>
    </div>
    <!-- /.content-header -->
</div>
  <!-- /.content-wrapper -->
  <script>
    function goBack() {
        window.history.back();
    }
  </script>
  <?= $this->endSection('content'); ?>


