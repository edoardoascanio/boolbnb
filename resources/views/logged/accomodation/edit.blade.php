@extends('layouts.app')

@section('content')
@include('layouts.components.error')
<div class="container">

    <p>* tutti i campi sono obbligatori</p>

    <form action="{{ route("logged.update", $accomodation->id ) }}" method="post" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ $accomodation->title }}">
        </div>

        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $accomodation->description }}"</textarea>
        </div>

        <div class="form-group">
            <label for="number_rooms">Numero di Stanze</label>
            <input type="number" name="number_rooms" id="number_rooms" cols="30" rows="10" class="form-control" placeholder="max: 20" value="{{ $accomodation->number_rooms }}">
        </div>

        <div class="form-group">
            <label for="number_bathrooms">Numero di Bagni</label>
            <input type="number" name="number_bathrooms" id="number_bathrooms" cols="30" rows="10" class="form-control" placeholder="max: 20" value="{{ $accomodation->number_bathrooms }}">
        </div>

        <div class="form-group">
            <label for="number_beds">Numero di Letti</label>
            <input type="number" name="number_beds" id="number_beds" cols="30" rows="10" class="form-control" placeholder="max: 20" value="{{ $accomodation->number_beds }}">
        </div>

        <div class="form-group">
            <label for="square_mts">Metri quadrati</label>
            <input type="number" name="square_mts" id="square_mts" cols="30" rows="10" class="form-control" value="{{ $accomodation->square_mts }}">
        </div>

        <div class="form-group">
            <label for="price_per_night">Prezzo per Notte</label>
            <input type="number" name="price_per_night" id="price_per_night" cols="30" rows="10" class="form-control" value="{{ $accomodation->price_per_night }}">
        </div>

        <div class="form-group">
            <label for="check_in">check in</label>
            <select name="check_in" id="check_in">
                <option value="" seletced> Scegli orario </option>
                @for($i = 0; $i < 24; $i++) <option value="{{ $i }}" {{ $i == $accomodation->check_in ? 'selected' : ""}}> {{ $i }}:00 </option>
                    @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="check_out">check out</label>
            <select name="check_out" id="check_out">
                <option value="" seletced> Scegli orario </option>
                @for($i = 0; $i < 24; $i++) <option value="{{ $i }}" {{ $i == $accomodation->check_out ? 'selected' : ""}}> {{ $i }}:00 </option>
                    @endfor
            </select>
        </div>

        {{-- AGGIUNGERE PLACEHOLDER IMG --}}
        <div class="form-group">
        <label for="placeholder">Carica img di copertina</label>
            <input type="file" name="placeholder" id="placeholder" accept=".jpg, .png, .svg, .jpeg">
        </div>

        {{-- services  --}}
        <div class="form-group">
            @foreach($services as $service)
            <label for="{{ $service->title }}">
                <input type="checkbox" name="services[]" value="{{ $service->id }}" id="{{ $service->title }}">
                {{ $service->title }}
            </label>
            @endforeach
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
      <label for="street_name">Nome della via</label>
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

    <div class="form-group" >
      <input
      id="newAccomodation"
        type="submit"
        value="CREA"
        class="form-control btn btn-success text-capitalize"
      />
    </div>
  </div>

    </form>
</div>

@endsection
