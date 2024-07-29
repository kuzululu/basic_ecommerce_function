<div id="map"></div>

<!-- add these script in bootstrap loaded api snippet usually it need these codes for new bs5 version -->
  <script>
    function initMap() {
      let location = {lat: 14.4687, lng: 120.9805};
      let map = new google.maps.Map(document.querySelector("#map"), {
        zoom: 15,
        center: location,
        mapTypeId: google.maps.MapTypeId.HYBRID
      });

      let popContent = 'AZGH COLLEGE INC <br> Atlas Compound Naga Rd., Pulanglupa I Las Piñas City, Metro Manila, Philippines <br> 874 6903';

      let info = new google.maps.InfoWindow({
        content: popContent
      });

      let marker = new google.maps.Marker({
        position: location,
        map: map,
        title: 'AZGH COLLEGE INC in Las Piñas'
      });

      marker.addListener('mouseover', function() {
        info.open(map, marker);
      });
    }
  </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrzBRd-5Zwq-ABwR28gRis9rqqNUwdN9E&callback=initMap" type="text/javascript"></script>

