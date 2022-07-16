<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
         <!-- Small boxes (Stat box) -->
         <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $totalLokasiMasjid;?></h3>
                <p>Masjid Terdaftar</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-mosque"></i>
              </div>
              <a href="/dasboard/daftarTempat" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $totalLokasiMusholla;?></h3>
                <p>Musholla/Surau Terdaftar</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-place-of-worship"></i>
              </div>
              <a href="/dasboard/daftarTempat" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $totalLokasiGereja;?></h3>
                <p>Gereja Terdaftar</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-church"></i>
              </div>
              <a href="/dasboard/daftarTempat" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><?= $totalLokasiWihara;?></h3>
                <p>Wihara Terdaftar</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-vihara"></i>
              </div>
              <a href="/dasboard/daftarTempat" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1 class="m-0">View Map</h1>
          </div><!-- /.col -->
          <div class="col-md-2 mb-2 ">
            <input type="text" class="form-control" placeholder="latitude" aria-label="latitude" value="" name="latitude">
          </div>
          <div class="col-md-2 mb-2">
            <input type="text" class="form-control" placeholder="longitude" aria-label="longitude" value="" name="longitude">
          </div>
          <div class="col-md-2 mb-2">
            <button type="button" class="btn btn-warning DariSini"><i class="bi bi-geo-alt-fill"></i></button>
          </div>
          <div class="col-md-2 mb-2">
            <button class="btn btn-danger text-bold float-end" onclick= 'fullscreenView()'>Full Map&nbsp;&nbsp;<i class="bi bi-arrows-fullscreen"></i></button>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
      <div id="map" style="height: 400px; width:100%;">
        <div class="control-coordinate"></div>
      </div>
    </div>
    <!-- modal View Detail -->
    <div class="modalView" style="display: none;"></div>
    <!-- /.content-header -->
</div>
  
  <!-- /.content-wrapper -->

  <script>
    // data
    var data = [
          <?php foreach($lokasi as $l){ ?>
            {"loc":[<?= $l['latitude']; ?>,<?= $l['longitude']; ?>], "title":"<?= $l['nama_tempat']; ?>", "gambar": "<?= $l['gambar']; ?>", "id_lokasi": "<?= $l['id_lokasi']; ?>", "lat": "<?= $l['latitude']; ?>", "lng": "<?= $l['longitude']; ?>"},
          <?php } ?>
    ]
    // marking place
    let latlng = [-0.049624, 109.317078];
    var map = new L.Map('map', {zoom: 12, center: new L.latLng(latlng) });
    L.control.defaultExtent().addTo(map);
    L.control.locate().addTo(map);
        map.addLayer(L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
            maxZoom: 18
        }));

    var markersLayer = new L.LayerGroup();  
    map.addLayer(markersLayer);

    // get location now
    getLocation();
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
    }
    function showPosition(position) {
      $("[name=latitude]").val(position.coords.latitude.toFixed(8));
      $("[name=longitude]").val(position.coords.longitude.toFixed(8));
    }

    // pencarian

    var controlSearch = new L.Control.Search({
      position:'topright',		
      layer: markersLayer,
      initial: false,
      zoom: 18,
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
        lat = data[i].lat,
        lng = data[i].lng,
        gambar = data[i].gambar,
        id_lokasi = data[i].id_lokasi,		//position found
        marker = new L.Marker(new L.latLng(loc), {title: title}, {gambar : gambar} );//se property searched
        marker.bindPopup("<p class='text-center'><b>" + title + "</b></p>" + "<img style='width:100%;height:100px;' src=/assets/gambarLokasi/images-location/" + gambar + "></img><br><br><a href=/dasboard/detail/" + id_lokasi + " class='btn btn-warning text-white'>Detail</a><button class='btn btn-info ms-2' onclick= 'return keSini(" + lat + "," +  lng + ")'>Go Here!</button>");
        markersLayer.addLayer(marker);
    }

    // kode gagal
    // <?php foreach($lokasi as $l): ?>
    //     var marker = new L.Marker(new L.latLng(<?= $l['latitude']; ?>,<?= $l['longitude']; ?>), {title:[<?= $l['nama_tempat'];?>]});
    //     marker.bindPopup("<?= $l['nama_tempat']; ?><br><image style='width:150px;height:100px; margin-top:4px;'src='/assets/gambarLokasi/images-location/<?= $l['gambar']; ?>'></image>")
    //     markersLayer.addLayer(marker);
    // <?php endforeach; ?>

    // mouseOver
    L.Control.Coordinate = L.Control.extend({
      onAdd: (map) => {
        let lat = 0;
        let lng = 109.352;
        let el = L.DomUtil.create("div", "control-coordinate");
        el.innerHTML = "Lat : <span class='latNow'>" + lat + "</span>, Lng : <span class='lngNow'>" + lng + "</span>";
        return el;
      },
    });

    let controlCoordinate = (opts) => {
      return new L.Control.Coordinate(opts);
    };

    controlCoordinate({ position: "bottomleft" }).addTo(map);

    map.on("mousemove", (e) => {
      let latlng = e.latlng;
      let latNow = document.querySelector(".latNow");
      let lngNow = document.querySelector(".lngNow");
      latNow.innerHTML = latlng.lat.toFixed(3);
      lngNow.innerHTML = latlng.lng.toFixed(3);
    });

    // akhir mouseOver

    // script routing

    var control = L.Routing.control({
        waypoints: [
         latlng
        ],
        geocoder: L.Control.Geocoder.nominatim(),
        routeWhileDragging:true,
        reverseWaypoints:true,
        showAlternatives:true,
        atLineOptions:{
          styles: [
            {color: 'black', opacity: 0.15, weight: 9},
            {color: 'white', opacity: 0.8, weight: 6},
            {color: 'blue', opacity: 0.5, weight: 2}
          ]
        }
    });
    control.addTo(map);
    // action button lokasi tujuan
    function keSini(lat,lng){
      var latlng = L.latLng(lat,lng);
      console.log(latlng);
      control.spliceWaypoints(control.getWaypoints().length - 1, 1, latlng);
    }
    // action button lokasi Sekarang
    $(document).on('click', '.DariSini', function(){
      let latlng = [$("[name=latitude]").val(), $("[name=longitude]").val()];
      control.spliceWaypoints(0, 1, latlng);
      map.panTo(latlng);
    })


</script>
<?= $this->endSection('content'); ?>
