<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      <button onclick="goBack()" class="btn btn-info"><i class="bi bi-arrow-return-left"></i></button>
         <!-- Small boxes (Stat box) -->
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">View Map - Cari </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
      <div id="map" style="height: 450px; width:100%;"></div>
    </div>
    <!-- /.content-header -->
</div>
  
  <!-- /.content-wrapper -->

  <script>

    // control search
    // data
    var data = [
          <?php foreach($lokasi as $l){ ?>
            {"loc":[<?= $l['latitude']; ?>,<?= $l['longitude']; ?>], "title":"<?= $l['nama_tempat']; ?>", "gambar": "<?= $l['gambar']; ?>", "id_lokasi": "<?= $l['id_lokasi']; ?>"},
          <?php } ?>
    ]
    // marking place
    var map = new L.Map('map', {zoom: 20, center: new L.latLng(<?= $lokasiNavigasi['latitude']; ?>,<?= $lokasiNavigasi['longitude']; ?>) });
    L.control.defaultExtent().addTo(map);
    L.control.locate().addTo(map);
        map.addLayer(L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
            maxZoom: 18
        }));
    //mark merah 
    var circle = L.circle([<?= $lokasiNavigasi['latitude']; ?>,<?= $lokasiNavigasi['longitude']; ?>], 10, {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5
    }).addTo(map);

    var markersLayer = new L.LayerGroup();  
    map.addLayer(markersLayer);

    // pencarian

    var controlSearch = new L.Control.Search({
      position:'topright',		
      layer: markersLayer,
      initial: false,
      zoom: 16,
      marker: false
    });

    map.addControl( new L.Control.Search ({
      layer: markersLayer,
      initial: false,
      collapsed:true,
      zoom:16
    }));

    for(i in data) {
      var title = data[i].title,	//value searched
        loc = data[i].loc,
        gambar = data[i].gambar,
        id_lokasi = data[i].id_lokasi,		//position found
        marker = new L.Marker(new L.latLng(loc), {title: title}, {gambar : gambar} );//se property searched
        marker.bindPopup("<p class='text-center'><b>&emsp;" + title + "&emsp;</b></p>" + "<img style='width:100%;height:100px;' src=/assets/gambarLokasi/images-location/" + gambar + "></img><br><br><a href=/dasboard/detail/" + id_lokasi + " class='btn btn-warning text-white'>Detail</a>");
        markersLayer.addLayer(marker);
    }

    // kode gagal
    // <?php foreach($lokasi as $l): ?>
    //     var marker = new L.Marker(new L.latLng(<?= $l['latitude']; ?>,<?= $l['longitude']; ?>), {title:[<?= $l['nama_tempat'];?>]});
    //     marker.bindPopup("<?= $l['nama_tempat']; ?><br><image style='width:150px;height:100px; margin-top:4px;'src='/assets/gambarLokasi/images-location/<?= $l['gambar']; ?>'></image>")
    //     markersLayer.addLayer(marker);
    // <?php endforeach; ?>

  </script>

   <script>
    function goBack() {
        window.history.back();
    }
  </script>
  <?= $this->endSection('content'); ?>