<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
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
    // var data = [
    //       <?php foreach($lokasi as $l){ ?>
    //         {"loc":[<?= $l['latitude']; ?>,<?= $l['longitude']; ?>], "title":"<?= $l['nama_tempat']; ?>", "gambar": "<?= $l['gambar']; ?>"},
    //       <?php } ?>
    // ]
    // marking place
    var map = new L.Map('map', {zoom: 16, center: new L.latLng(-0.049624, 109.317078) });
    L.control.defaultExtent().addTo(map);
        map.addLayer(L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }));

    var markersLayer = new L.LayerGroup();  
    map.addLayer(markersLayer);

    // searching
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

    // for(i in data) {
    //   var title = data[i].title,	//value searched
    //     loc = data[i].loc,
    //     gambar = data[i].gambar,		//position found
    //     marker = new L.Marker(new L.latLng(loc), {title: title}, {gambar : gambar} );//se property searched
    //     marker.bindPopup(title + "<br>"+ "<button class='btn btn-success' onclick='return kesini("+ loc + ")'>Kesini</button>");
    //     markersLayer.addLayer(marker);
    // }
    <?php foreach($lokasi as $l): ?>
        var marker = new L.Marker(new L.latLng([<?= $l['latitude']; ?>,<?= $l['longitude']; ?>]))
        .bindPopup("<?= $l['nama_tempat']; ?><br><image style='width:150px;height:100px; margin-top:4px;'src='/assets/gambarLokasi/images-location/<?= $l['gambar']; ?>'></image>")
        .openPopup();
        markersLayer.addLayer(marker);
    <?php endforeach; ?>
    // routing
    var control = L.Routing.control({
        waypoints: [
            L.latLng(-0.049624, 109.317078),
            L.latLng(-0.039624, 109.315078)
        ],
        routeWhileDragging:true
    }).
    control.addTo(map);
  </script>
  <?= $this->endSection('content'); ?>