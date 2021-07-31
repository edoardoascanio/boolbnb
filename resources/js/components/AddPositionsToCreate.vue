<template>
  <div>
      <form action="#"  enctype="multipart/form-data">
    <div class="form-group">
      <label for="title">Titolo</label>
      <input type="text" id="title" name="title" class="form-control" />
    </div>

    <div class="form-group">
      <label for="description">Descrizione</label>
      <textarea
        name="description"
        id="description"
        cols="30"
        rows="10"
        class="form-control"
      ></textarea>
    </div>

    <div class="form-group">
      <label for="number_rooms">Numero di Stanze</label>
      <input
        type="number"
        name="number_rooms"
        id="number_rooms"
        cols="30"
        rows="10"
        class="form-control"
        placeholder="max: 20"
      />
    </div>

    <div class="form-group">
      <label for="number_bathrooms">Numero di Bagni</label>
      <input
        type="number"
        name="number_bathrooms"
        id="number_bathrooms"
        cols="30"
        rows="10"
        class="form-control"
        placeholder="max: 20"
      />
    </div>

    <div class="form-group">
      <label for="number_beds">Numero di Letti</label>
      <input
        type="number"
        name="number_beds"
        id="number_beds"
        cols="30"
        rows="10"
        class="form-control"
        placeholder="max: 20"
      />
    </div>

    <div class="form-group">
      <label for="square_mts">Metri quadrati</label>
      <input
        type="number"
        name="square_mts"
        id="square_mts"
        cols="30"
        rows="10"
        class="form-control"
      />
    </div>

    <div class="form-group">
      <label for="price_per_night">Prezzo per Notte</label>
      <input
        type="number"
        name="price_per_night"
        id="price_per_night"
        cols="30"
        rows="10"
        class="form-control"
      />
    </div>

    <div class="form-group">
      <label for="check_in">check in</label>
      <select name="check_in" id="check_in">
        <option value="" seletced>-- Scegli orario --</option>
        <option v-for="i in 24" :key="i" :value="i">
         
        </option>
      </select>
    </div>

    <div class="form-group">
      <label for="check_out">check out</label>
      <select name="check_out" id="check_out">
        <option value="" seletced>-- Scegli orario --</option>
        <option v-for="i in 24" :key="i" :value="i">
          
        </option>
      </select>
    </div>

    <div class="form-group">
      <label for="country">Paese</label>
      <input
        type="text"
        name="country"
        id="country"
        cols="30"
        rows="10"
        class="form-control"
      />
    </div>

    <div class="form-group">
      <label for="city">Citta'</label>
      <input
        type="text"
        name="city"
        id="city"
        cols="30"
        rows="10"
        class="form-control"
      />
    </div>

    <div class="form-group">
      <label for="province">Provincia</label>
      <input
        type="text"
        name="province"
        id="province"
        cols="30"
        rows="10"
        class="form-control"
      />
    </div>

    <div class="form-group">
      <label for="zip">CAP</label>
      <input
        type="text"
        name="zip"
        id="zip"
        cols="30"
        rows="10"
        class="form-control"
      />
    </div>

    <div class="form-group">
      <label for="street_name">Tipo di via</label>
      <select id="type_street" name="type_street">
        <option value="via" selected>Via</option>
        <option value="piazza">Piazza</option>
        <option value="vicolo">Vicolo</option>
      </select>
    </div>

    <div class="form-group">
      <label for="street_name">Indirizzo</label>
      <input
        type="text"
        name="street_name"
        id="street_name"
        cols="30"
        rows="10"
        class="form-control"
      />
    </div>

    <div class="form-group">
      <label for="building_number">Numero Civico</label>
      <input
        type="number"
        name="building_number"
        id="building_number"
        cols="30"
        rows="10"
        class="form-control"
      />
    </div>

    <label
      v-for="service in services"
      :key="service.id"
      :for="service.title + '-' + service.id"
    >
      <input
        type="checkbox"
        name="services[]"
        :value="service.id"
        :id="service.title + '-' + service.id"
      />
      {{ service.title }}
    </label>

    <!-- <div class="form-group">
        <input type="submit" value="Crea" class="form-control btn btn-success text-capitalize" @click="register()">
    </div> -->

</form>

  </div>
</template>

<script>
export default {
  name: "AddPositionsToCreate",
  data() {
    return {
      services: [],
      link: 'http://127.0.0.1:8000/logged/store',
    };
  },
  methods: {
    callPositions() {},
    callServices() {
      axios.get("/api/services").then((resp) => {
        this.services = resp.data.results;
      });
    },
    register() {
      this.form.post("/logged/store").then((response) => {
        var attr = document.getElementById("text");
        attr.innerHTML = response.data.message;

        this.form.reset();
        console.log("ciao");
      });
    console.log('ciao')
    },
  },
  mounted() {
    this.callServices();
  },
};
</script>