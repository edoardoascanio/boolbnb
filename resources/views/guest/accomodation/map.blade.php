@extends('layouts.mapLayout')
@section('content')
<div class="d-flex"  >
    <form @submit.prevent="filterData" class=" bg-light flex-wrap"  id="searchForm">
            <div>
                <input type="text" placeholder="citta" id="city" value="{{ $city['city'] }}">
            </div>
            <div >
                <input type="number" placeholder="n letti" id="beds" value="{{ $number_beds['number_beds'] }}">
            </div>
            <div >
                <input type="number" placeholder="n stanze" id="rooms">
            </div>
            <div >
                    <label for="range" class="forma-label mb-0">Distanza:</label>
                    <span id="ciccio">20 Km</span>
                <input class=" p-0" type="range" id="range" name="range" min="0" max="40" step="1" list="tickmarks" />
                <datalist id="tickmarks">
                    <option value="0"></option>
                    <option value="5"></option>
                    <option value="10"></option>
                    <option value="15"></option>
                    <option value="20"></option>
                    <option value="25"></option>
                    <option value="30"></option>
                    <option value="35"></option>
                    <option value="40"></option>
                </datalist>
            </div>
            {{-- <div class="mb-3">ciao</div> --}}
        <div>
            @foreach($services as $service)
            <label for="{{ $service->id }}">
                <input type="checkbox" id="{{ $service->id }}" class="services" value="{{ $service->id }}" name="service">
                {{$service->title}}
            </label>
            @endforeach
        </div>
        <div>
            <input type="button" id="el" value="FILTRA" />
            <input type="reset" value="RESET" onclick="doSomethingWith(20)"/>
        </div>
    </form>
</div>
<div class="container_map" id="container_map" style="margin-top: 80px; height: calc(100vh - 80px);">
    <div class='control-panel'>
        <div id='store-list'></div>
    </div>
    <div class='map' id='map' style="height:100%; width: 40%"></div>
</div>

<script>
    //Mappa e suoi spostamenti
     let apiKey = 'x03gOYgHS1403BuzYDLDXT3SZEhCK1sB';
                let map = tt.map({
                    key: apiKey, 
                    container: 'map', 
                    center: [42, 12],
                    zoom: 5
                 });
        let moveMap = function(lnglat) {
            map.flyTo({
                center: lnglat,
                zoom: 10
            })
        }
        let handleResults = function(result) {
            if (result.results) {
                moveMap(result.results[0].position)
            }
        }
        let search = function() {
            tt.services.fuzzySearch({
                key: apiKey,
                query: document.getElementById("city").value,
            }).go().then(handleResults)    
        }
    var searchButton = document.getElementById("searchButton")
    var mapContainer = document.getElementById("container_map")
    var formDisplay = 1
    searchButton.addEventListener("click", function () {
        var form = document.getElementById("searchForm")
        if (form.style.display === "none") {
            form.style.display = "flex"; 
        } else {
            form.style.display = "none";         
  }
    })
    var dynamicRange = document.getElementById('range');
    dynamicRange.addEventListener('input', function(event) {
        var inputValue = event.target.value;
        doSomethingWith(inputValue);
    });
    function doSomethingWith(value) {
        console.log(value)
        var myel = document.getElementById("ciccio");
        myel.innerHTML = value + " Km"
    }
    var arrayAccomodation = [];
    var el = document.getElementById('el')
    el.addEventListener('click', function() {
        clearAccomodations()
    })
    el.addEventListener('click', function() {
        clearAccomodations()
    })
    el.addEventListener('click', function() {
        callAccomodations()
    })
    el.addEventListener('click', function() {
        search()
    })
    let stores = {
        "type": "FeatureCollection"
        , "features": arrayAccomodation
    };
    window.addEventListener('load', () => {
        callAccomodations()
    })
    window.addEventListener('load', () => {
        search()
    })
    function clearAccomodations() {
        arrayAccomodation = []
        var mylength = $('[id^=banana]').length
        if (mylength > 0) {
            for (i = 0; mylength; i++) {
                var myobj = document.getElementById("banana");
                myobj.remove();
            }
        }
        myMarkerLength = $(".mapboxgl-marker-anchor-bottom").length
        for (y = 0; y < myMarkerLength; y++) {
            $(".mapboxgl-marker-anchor-bottom").remove()
        }
    }
    function callAccomodations() {
        var filteredAccomodations = []
        stores = {
            "type": "FeatureCollection"
            , "features": arrayAccomodation
        };
        var city = document.getElementById('city').value
        var beds = document.getElementById('beds').value
        var rooms = document.getElementById('rooms').value
        var range = document.getElementById('range').value
        var services = document.getElementsByClassName('services')
        var empty = [].filter.call(services, function(el) {
            return !el.checked.value
        });
        var servicesValue = []
        $.each($("input[name='service']:checked"), function() {
            servicesValue.push(parseInt($(this).val()));
        });
        axios.get("/api/accomodation/filtered", {
                params: {
                    city: city
                    , number_beds: beds
                    , number_rooms: rooms
                    , services: servicesValue
                    , range: range
                }
            })
            .then((resp) => {
                filteredAccomodations = resp.data.results;
                console.log(servicesValue)
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
                            //Aggiungere qua 1
                            "address": filteredAccomodations[i].street_name + " " + filteredAccomodations[i].building_number + ", " + filteredAccomodations[i].zip + " " + filteredAccomodations[i].province
                            , "city": filteredAccomodations[i].city
                            , "title": filteredAccomodations[i].title
                            , "number_rooms": filteredAccomodations[i].number_rooms
                            , "placeholder": filteredAccomodations[i].placeholder,
                            "link": filteredAccomodations[i].link
                        }
                    }, )
                }
                let markersCity = [];
                let list = document.getElementById('store-list');
                stores.features.forEach(function(store, index) {
                    //Aggiungere qua 2
                    let placeholder = store.properties.placeholder;
                    let city = store.properties.city;
                    let address = store.properties.address;
                    let location = store.geometry.coordinates;
                    let title = store.properties.title;
                    let link = store.properties.link
                    let marker = new tt.Marker().setLngLat(location).setPopup(new tt.Popup({
                        offset: 35
                    , }).setHTML(address)).addTo(map);
                    markersCity[index] = {
                        marker
                        //Forse aggiungere qua
                        , placeholder
                        , city
                        , title
                    , };
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
                        let details = htmlParent.appendChild(document.createElement('a'));
                        details.href =  link;
                        details.className = 'list-entry';
                        details.innerHTML = "<img style='height: 100px; width: 100px;' src='" + placeholder + "' alt=''> " + "<h2>" + title + "</h2>" + "<p>" + text + "</p>";
                        details.target = "_blanc"
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
@endsection

