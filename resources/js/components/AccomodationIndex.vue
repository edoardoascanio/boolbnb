<template>
  <div>
    
      <div class="card-body">
        <form @submit.prevent="filterData">
          <div class="row">
            <text-input label="Città" v-model="filters.city"> </text-input>

            <text-input
              label="N. minimo di stanze"
              v-model="filters.number_rooms"
            >
            </text-input>

            <text-input
              label="N. minimo di letti"
              v-model="filters.number_beds"
            >
            </text-input>

            <div class="mb-3">
              <label for="distance" class="forma-label">Distanza</label>
              <input
                class="form-control"
                type="range"
                id="distance"
                name="distance"
                min="0"
                max="40"
                step="1"
                list="tickmarks"
                v-model="filters.distance"
              />

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
            <div class="mb-3">{{ filters.distance }}</div>
          </div>

          <div v-for="service in services" :key="service.id">
            <label :for="service.title">
              {{ service.title }}
              <input
                type="checkbox"
                v-model="filters.services"
                :value="service.id"
                :name="service.title"
                :id="service.title"
              />
            </label>
          </div>

          <div>
            <input
              type="button"
              value="FILTRA"
              @click="filteredAccomodationsCall()"
            />
            <input type="button" value="RESET" @click="resetAccomodations()" />
          </div>
        </form>
      </div>
    
 <!-- <div class='control-panel'>
        <div class='heading'>
            <img src='https://d1yjjnpx0p53s8.cloudfront.net/styles/logo-thumbnail/s3/032017/untitled-6_25.png?itok=9ZEI6gJ3'>
        </div>
        <div id='store-list'></div>
    </div>
    <div class='map' id='map'></div> -->
    <div class="row">
      <div class="col-4">
        <div
          class="card"
          style="width: 100%"
          v-for="accomodation in filteredAccomodations"
          :key="accomodation.id"
        >
          <div class="card-body">
            <img
              :src="accomodation.placeholder"
              alt="..."
              class="img-thumbnail"
            />
            <h5 class="card-title">{{ accomodation.title }}</h5>
            <p class="card-text">{{ accomodation.description }}</p>
            <div>
              <span class="badge badge-primary ml-1" v-for="service in accomodation.services" :key="service.id"> {{ service.title }} </span>
            </div>
            <a :href="accomodation.link" class="card-link">Visualizza</a>
            <p v-if="accomodation.views">
              Views: {{ accomodation.views.length }}
            </p>
          </div>
        </div>
      </div>

      <div class="col-8">
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AccomodationIndex",
  data() {
    return {
      originalAccomodations: [],
      filteredAccomodations: [],
      store: {
        type: "FeatureCollection",
        features: [],
      },
      services: [],
      filters: {
        city: "",
        number_rooms: "",
        number_beds: "",
        distance: 20,
        services: [],
      },
    };
  },
  methods: {
    storesAccomodations() {
      // console.log("store");
      this.filteredAccomodations.forEach((el) => {
        // console.log("store in foreach");
        this.store.features.push({
          type: "Feature",
          geometry: {
            type: "Point",
            coordinates: [el.lon, el.lat],
          },
          properties: {
            address:
              el.type_street +
              el.street_name +
              el.building_number +
              ", " +
              el.zip +
              " - " +
              el.province,
            city: el.city,
          },
        });
      });
    },
    resetAccomodations() {
      this.filteredAccomodations = this.originalAccomodations;
    },
    callAccomodations() {
      axios
        .get("/api/accomodation")
        .then((resp) => {
          this.originalAccomodations = resp.data.results.data;
          this.filteredAccomodations = resp.data.results.data;
          this.storesAccomodations();

          // console.log(this.filteredAccomodations);
        })
        .catch((er) => console.log(er));
    },
    filteredAccomodationsCall() {
      axios
        .get("/api/accomodation/filtered", {
          params: this.filters,
        })
        .then((resp) => {
          this.filteredAccomodations = resp.data.results;
          console.log(this.filters);
        })
        .catch((er) => console.log(er));
    },
    callMap() {
      console.log("ciao");
      this.originalAccomodations.forEach((accomodation) => {
        var compactStreetName = accomodation.street_name.replace(/\s/g, "");

        var urlGetPosition =
          "https://boolbnbproxy.herokuapp.com/https://api.tomtom.com/search/2/geocode/" +
          accomodation.province +
          "%20" +
          accomodation.city +
          "%20" +
          accomodation.type_street +
          "%20" +
          compactStreetName +
          "%20" +
          accomodation.building_number +
          ".json?Key=t4QufcKAvdkiBeKqaOB5kwMYk71Rx8b6";
        axios
          .get(urlGetPosition)
          .then((resp) => {
            console.log(urlGetPosition);

            // this.z.push(resp.data.results.position);
            console.log(resp.data.result[0].position);
          })
          .catch((er) => {
            console.log(er);
          });
      });
    },
    callServices() {
      axios.get("/api/services").then((resp) => {
        this.services = resp.data.results;
      });
    },
  },
  mounted() {
    this.callAccomodations();
    this.callServices();
    setTimeout(this.storesAccomodations(), 1000);
    // this.callMap();
  },
};
</script>

<style  scoped>
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