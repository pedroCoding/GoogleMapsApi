/* Scripts */

// Variable for coordinate picking mode
var coordinatePickingMode = false;

// Test locations
var testResults = [{lat: 60.169290, lng: 24.928217}, {lat: 60.169497, lng: 24.933689}, {lat: 60.170768, lng: 24.941535}, {lat: 60.175841, lng: 24.804531}];

// Main variable for fetched places
var locationsFromDB = [];

// AJAX content loading
function loadAjax(page){
  switch (page) {
    case "new":
    $("#addPlace").load("../GOOGLEMAPSAPI/views/new/addNew.html");
        break; 
    case "edit":
    $("#listPlaces").load("../GOOGLEMAPSAPI/views/edit/edit.html");
        break; 
    default: 
    // Do nothing basically
  }
}

// Get added places locations from database and place them on map
function fetchMarkersFromDB(){
  loadAjax('new');
  $.ajax({
    type: "GET",
    url: "getMapMarkers.php",     
    dataType: 'json',    
    success: function(response){                    
        locationsFromDB = response;
        console.log(locationsFromDB);
        // Init map
        initMap();
    },
    error: function(response){                    
      toastr.error('response: ' + response, 'Fetching map markers from database failed :(');
      // Init map anyways
      initMap();
  }
  }); 
}

// Call fetchMarkersFromDB() when page has loaded
$( document ).ready(function() {
  fetchMarkersFromDB();
});

//Initialize map
function initMap() {
  console.log("init map here");
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom:15,
    center: new google.maps.LatLng(-6.349523, -39.310635)
  });
  // Loop locations to map
  for (var i = 0; i < locationsFromDB.length; i++) {
    var latLng = new google.maps.LatLng(locationsFromDB[i].lat,locationsFromDB[i].lng);
    var marker = new google.maps.Marker({
        position: latLng,
        map: map
    });
  }
  // Click event for coordinate picking
  map.addListener('click', function(e) {
    if (coordinatePickingMode === true){
      GetCoordinatesFromMap(e.latLng, map);
    } else {
      // do nothing so that map can be operated normally
    }
  });
}

// Function for getting coordinates from map
function GetCoordinatesFromMap(latLng, map) {
  //Optional code for if we want to add a marker on the map too
  // var marker = new google.maps.Marker({
  //   position: latLng,
  //   map: map
  // });
  // map.panTo(latLng);
  console.log("Novo marcador adicionado, lat: " + latLng.lat() + " lng: " + latLng.lng());
  // Insert picked coordinates to form fields
  $("#lat").val(latLng.lat());
  $("#latEdit").val(latLng.lat());
  $("#lng").val(latLng.lng());
  $("#lngEdit").val(latLng.lng());
  // Disable coordinatePickingMode
  coordinatePickingMode = false;
  // Reset button state
  $("#pickFromMapBtn").html("Pingue no Mapa");
  $("#pickFromMapBtn2").html("Pingue no Mapa");
  $("#map").removeClass("pickingModeActive");
  // Inform user
  toastr.info('lat: ' + latLng.lat() + ', lng: ' + latLng.lng(), 'Coordenadas selecionadas no Mapa!');
}

//We only want to pick coordinates when button is pressed so we handle that with this function for now
function setPickingMode(){
  if (coordinatePickingMode === false){
    coordinatePickingMode = true;
    $("#pickFromMapBtn").html("Cancelar seleção");
    $("#map").addClass("pickingModeActive");
  } else {
    coordinatePickingMode = false;
    $("#pickFromMapBtn").html("Pingue no Mapa");
    $("#map").removeClass("pickingModeActive");
  }
}


function setPickingMode2(){
  if (coordinatePickingMode === false){
    coordinatePickingMode = true;
    $("#pickFromMapBtn2").html("Cancelar seleção");
    $("#map").addClass("pickingModeActive");
  } else {
    coordinatePickingMode = false;
    $("#pickFromMapBtn2").html("Pingue no Mapa");
    $("#map").removeClass("pickingModeActive");
  }
}
