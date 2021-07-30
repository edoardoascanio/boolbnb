@extends('layouts.mapLayout')

@section('content')



<div class='control-panel'>
    <div class='heading'>
        <img src='https://d1yjjnpx0p53s8.cloudfront.net/styles/logo-thumbnail/s3/032017/untitled-6_25.png?itok=9ZEI6gJ3'>
        <button onclick="clearAccomodations(); ">Cleara Accomodations</button>
        <button onclick="callAccomodations()">Chiama Accomodations</button>
    </div>
    <div id='store-list'></div>
</div>
<div class='map' id='map' style="width: 75%; height: 100%"></div>


<script>
   
    //myMethods
    //
    //
    var originalAccomodations = null;
    var filteredAccomodations = null
    var arrayAccomodation = [];
    let stores = {
        "type": "FeatureCollection"
        , "features": arrayAccomodation
    };

window.addEventListener('load', () => {
    callAccomodations()
})

function mixAccomodations() {
    clearAccomodations()
    clearAccomodations()
    
}



    function clearAccomodations() {
        arrayAccomodation = []

        
        

        var mylength = $('[id^=banana]').length 

        for(i=0; mylength; i++) {
            var myobj = document.getElementById("banana");
        myobj.remove();
        }

        myMarkerLength = $( ".mapboxgl-marker-anchor-bottom" ).length

        for(y=0; y<myMarkerLength; y++) {
            $( ".mapboxgl-marker-anchor-bottom" ).remove()
        }

        
        
        //callAccomodations()

        // myPointerLength = document.getElementsByClassName("mapboxgl-marker-anchor-bottom").length

        // for(i=0; i<myPointerLength; i++) {
        //     document.getElementsByClassName("mapboxgl-marker-anchor-bottom").remove()
            
        // }
        // console.log(document.getElementsByClassName("mapboxgl-marker-anchor-bottom").length)
        // var myMarker = document.getElementsByClassName("mapboxgl-marker-anchor-bottom")
        // myMarker.remove()

        

        
        
        
        
    }

    function callAccomodations() {


        axios.get("/api/accomodation").then((resp) => {
            originalAccomodations = resp.data.results.data;
            filteredAccomodations = resp.data.results.data;

            for (i = 0; i < filteredAccomodations.length; i++) {
                arrayAccomodation.push({
                    "type": "Feature"
                    , "geometry": {
                        "type": "Point"
                        , "coordinates": [
                            filteredAccomodations[i].lon
                            , filteredAccomodations[i].lat
                        ]
                    }
                    , "properties": {
                        "address": filteredAccomodations[i].street_name + " " + filteredAccomodations[i].building_number + ", " + filteredAccomodations[i].zip + " " + filteredAccomodations[i].province,
                        "city": filteredAccomodations[i].city,
                        "title": filteredAccomodations[i].title,
                        "number_rooms": filteredAccomodations[i].number_rooms,
                        "placeholder": "https://i0.wp.com/reviveyouthandfamily.org/wp-content/uploads/2016/11/house-placeholder.jpg?ssl=1"
                    }
                }, )

                


            }

            let apiKey = 'x03gOYgHS1403BuzYDLDXT3SZEhCK1sB';
            let map = tt.map({
                key: apiKey, 
                container: 'map',
                center: [filteredAccomodations[1].lon, filteredAccomodations[1].lat],
                zoom: 18,

            });

            let markersCity = [];
            let list = document.getElementById('store-list');

            stores.features.forEach(function(store, index) {

                let placeholder = store.properties.placeholder;
                let city = store.properties.city;
                let address = store.properties.address;
                let location = store.geometry.coordinates;
                let title = store.properties.title;
                let marker = new tt.Marker().setLngLat(location).setPopup(new tt.Popup({
                    offset: 35,
                    
                }).setHTML(address)).addTo(map);
                markersCity[index] = {
                    marker,
                    placeholder,
                    city,
                    title,
                };

                let cityStoresList = document.getElementById(city);
                if (cityStoresList === null) {
                    let cityStoresListHeading = list.appendChild(document.createElement('h3'));
                    // cityStoresListHeading.innerHTML = city;
                    cityStoresList = list.appendChild(document.createElement('div'));
                    cityStoresList.id = "banana";

                    cityStoresList.className = 'list-entries-container';
                    cityStoresListHeading.addEventListener('click', function(e) {
                        map.fitBounds(getMarkersBoundsForCity(e.target.innerText), {
                            padding: 50
                        });
                    });
                }

                let details = buildLocation(cityStoresList, address, title);

                marker.getElement().addEventListener('click', function() {
                    let activeItem = document.getElementsByClassName('selected');
                    if (activeItem[0]) {
                        activeItem[0].classList.remove('selected');
                    }
                    details.classList.add('selected');
                    openCityTab(city);
                });

                details.addEventListener('click', function() {
                    let activeItem = document.getElementsByClassName('selected');
                    if (activeItem[0]) {
                        activeItem[0].classList.remove('selected');
                    }
                    details.classList.add('selected');
                    map.easeTo({
                        center: marker.getLngLat()
                        , zoom: 12
                    });
                    closeAllPopups();
                    marker.togglePopup();

                });

                function buildLocation(htmlParent, text) {
                    let details = htmlParent.appendChild(document.createElement('div'));
                    details.href = '#';
                    details.className = 'list-entry';
                    details.innerHTML = "<img style='height: 100px; width: 100px;' src='" + placeholder + "' alt=''> " + "<h2>" + title + "</h2>" + "<p>" + text + "</p>" ;
                    return details;
                }

                function closeAllPopups() {
                    markersCity.forEach(markerCity => {
                        if (markerCity.marker.getPopup().isOpen()) {
                            markerCity.marker.togglePopup();
                        }
                    });
                }

                function getMarkersBoundsForCity(city) {
                    let bounds = new tt.LngLatBounds();
                    markersCity.forEach(markerCity => {
                        if (markerCity.city === city) {
                            bounds.extend(markerCity.marker.getLngLat());
                        }
                    });
                    return bounds;
                }

                function openCityTab(selected_id) {
                    let storeListElement = $('#store-list');
                    let citiesListDiv = storeListElement.find('div.list-entries-container');
                    for (let activeCityIndex = 0; activeCityIndex < citiesListDiv.length; activeCityIndex++) {
                        if (citiesListDiv[activeCityIndex].id === selected_id) {
                            storeListElement.accordion('option', {
                                'active': activeCityIndex
                            });
                        }
                    }
                }
            });

            


        })

    }

    

</script>


<script>

</script>



<style>
    html {
    -webkit-box-sizing: border-box;
            box-sizing: border-box;
}

*, *:before, *:after {
    box-sizing: inherit;
}

body {
    color: #707070;
    font-size: 14px;
    margin: 0;
    padding: 0;
}

a {
    text-decoration: none;
}

.map {
    bottom: 0;
    left: 25%;
    position: absolute;
    top: 0;
    width: 75%;
}

.control-panel {
    -webkit-box-shadow: 0px 0px 12px 0px rgba(0, 0, 0, 0.3);
            box-shadow: 0px 0px 12px 0px rgba(0, 0, 0, 0.3);
    height: 100%;
    left: 0;
    overflow: hidden;
    position: absolute;
    top: 0;
    width: 25%;
}

.heading {
    background: #fff;
    border-bottom: 1px solid #eee;
    -webkit-box-shadow: 0px 3px 6px 0px rgba(0, 0, 0, 0.16);
            box-shadow: 0px 3px 6px 0px rgba(0, 0, 0, 0.16);
    position: relative;
    z-index: 1;
}

.heading > img {
    height: auto;
    margin: 10px 0 8px 0;
    width: 150px;
}

#store-list {
    height: 100%;
    overflow: auto;
}

#store-list .list-entries-container .list-entry {
    border-bottom: 1px solid #e8e8e8;
    display: block;
    padding: 10px 50px 10px;
}

#store-list .list-entries-container .list-entry:nth-of-type(even) {
    background-color: #f5f5f5;
}

#store-list .list-entries-container .list-entry:hover,
#store-list .list-entries-container .list-entry.selected {
    background-color: #CDDE75;
    border-bottom-color: #CDDE75;
}

.ui-accordion h3.ui-accordion-header {
    background-color: #F4F6F8;
    border-color: #dddfe0;
    border-style: solid;
    border-width: 0 0 3px 0;
    color: #707070;
    display: block;
    font-size: 1.143em;
    margin: 0;
    padding: 15px 20px;
}

.ui-accordion h3.ui-accordion-header.ui-state-active {
    color: #fff;
    background-color: #BDD731;
    border-bottom-color: #a2ba24;
}

.ui-accordion .ui-accordion-content {
    border: none;
    padding: 0;
}

.ui-icon, .ui-widget-content .ui-icon {
    margin-right: 15px;
}

</style>








@endsection
