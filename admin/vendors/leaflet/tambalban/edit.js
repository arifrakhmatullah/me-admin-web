//script mendapatkan nilai titik latlng
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        view.innerHTML = "Yah browsernya ngga support Geolocation bro!";
    }
}
 function showPosition(position) {
   document.getElementById('lat').value = position.coords.latitude;
   document.getElementById('lng').value = position.coords.longitude; 
 }
 
 function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            view.innerHTML = "Yah, mau deteksi lokasi tapi ga boleh :("
            break;
        case error.POSITION_UNAVAILABLE:
            view.innerHTML = "Yah, Info lokasimu nggak bisa ditemukan nih"
            break;
        case error.TIMEOUT:
            view.innerHTML = "Requestnya timeout bro"
            break;
        case error.UNKNOWN_ERROR:
            view.innerHTML = "An unknown error occurred."
            break;
    }
 }

// Get current position successfully
function success(position) {
latitude= document.getElementById('lat');
longitude= document.getElementById('lng');
lat = latitude.value;
lng = longitude.value;

  // Instance map using leaflet
  map = L.map('map').setView([lat, lng], 18);
  
  // Tile layer using key api at cloudmade.com
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    key: '760506895e284217a7442ce2efe97797',
    styleId: 103288,
    maxZoom: 18
  }).addTo(map);

  // Marker using leaflet
  marker = L.marker([lat, lng],{draggable: 'true'}).addTo(map);

  marker.on('dragend', function(event) {
    var position = marker.getLatLng();
    marker.setLatLng(position, {
      draggable: 'true'
    }).bindPopup(position).update();
    $("#lat").val(position.lat);
    $("#lng").val(position.lng).keyup();
  });

  $("#lat, #lng").change(function() {
    var position = [parseInt($("#lat").val()), parseInt($("#lng").val())];
    marker.setLatLng(position, {
      draggable: 'true'
    }).bindPopup(position).update();
    map.panTo(position);
  });

  map.addLayer(marker);
  
  // Popup in leaflet
  marker.bindPopup('<p>Posisi Kamu</p>').openPopup();
}

// Get current position fail
function error() {
  alert('Get current position fail. Please Check Your Internet Connection.');
}

// Init load document
var show = document.getElementById('show');

show.addEventListener('click', function(e) {
  e.preventDefault();
  if (!navigator.geolocation) {
    console.log("Browser doesn't support geolocation");
  } else {
    navigator.geolocation.getCurrentPosition(success, error);
  }
}, false);



//script UNtuk Mengubah Format Rupiah
		
		var harga = document.getElementById('harga');
		harga.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			harga.value = formatRupiah(this.value, 'Rp. ');
		});
 
		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			harga     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				harga += separator + ribuan.join('.');
			}
 
			harga = split[1] != undefined ? harga + ',' + split[1] : harga;
			return prefix == undefined ? harga : (harga ? 'Rp. ' + harga : '');
		}
		
		
		
		
		
		//script UNtuk input hanya boleh angka
		
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
		
		
		//script tombol reset latlng				
function resetLatLng() {
 $('input[name=lat').val('').reset;
 $('input[name=lng').val('').reset;
}

	//script untuk menampilkan preview gambar
  function tampilkanPreview(gambar,idpreview){
                var gb = gambar.files;
                for (var i = 0; i < gb.length; i++){
                    var gbPreview = gb[i];
                    var imageType = /image.*/;
                    var preview=document.getElementById(idpreview);            
                    var reader = new FileReader();
                    
                    if (gbPreview.type.match(imageType)) {
                        preview.file = gbPreview;
                        reader.onload = (function(element) { 
                            return function(e) { 
                                element.src = e.target.result; 
                            }; 
                        })(preview);
                        reader.readAsDataURL(gbPreview);
                    }else{
                        alert("file yang anda upload tidak sesuai. Khusus mengunakan image.");
                    }
                   
                }    
            }