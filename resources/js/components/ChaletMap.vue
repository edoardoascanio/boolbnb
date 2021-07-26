<template> 
<div>


    <h1>Vue 3 TomTom Maps Demo</h1> 
    <div id='map' ref="mapRef"></div> 
</div>
</template> 
 
<script> 
export default { 
  name: 'Map',
  setup() { 
    const mapRef = ref(null); 
    onMounted(() => { 
       
            const tt = window.tt; 
            var map = tt.map({ 
            key: '<INSERT API KEY HERE>', 
            container: mapRef.value, 
            style: 'tomtom://vector/1/basic-main', 
        }); 
        map.addControl(new tt.FullscreenControl()); 
        map.addControl(new tt.NavigationControl());
        addMarker(map)
    }) 
 function addMarker(map) { 
    const tt = window.tt; 
    var location = [-121.91595, 37.36729]; 
    var popupOffset = 25; 
 
    var marker = new tt.Marker().setLngLat(location).addTo(map); 
    var popup = new tt.Popup({ offset: popupOffset }).setHTML("Your address!"); 
            marker.setPopup(popup).togglePopup(); 
} 

    return { 
      mapRef, 
    }; 
} 
}
</script>
<style> 
#map { 
    height: 50vh; 
    width: 50vw; 
} 
</style> 