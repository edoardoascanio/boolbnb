@extends('layouts.app')

@section('content')
@include('layouts.components.error')
<div class="container create-container">

    <p> <i class="fa fa-asterisk"></i><span><em> <strong>Tutti i campi sono obbligatori</strong></em></p>

    <form action="{{ route("logged.store") }}" method="post" enctype="multipart/form-data">

        @csrf
        <div class="form-group">
            <label for="customSwitch1">Visibile
                <input name="visibility" type="radio" value="1" id="true">
            </label>

            <label for="customSwitch1">Non visibile
                <input name="visibility" type="radio" value="0" id="false" checked>
            </label>
        </div>

        <div class="row">
            <div class="form-group title col-6 align-items-center">
                <label for="title">Titolo</label>
                <input type="text" id="title" name="title" class="form-control">
            </div>

            <div class="form-group load-img col-6">
                <label for="placeholder">Carica img di copertina</label>
                <input type="file" name="placeholder" id="placeholder" accept=".jpg, .png, .svg, .jpeg">
            </div>
        </div>

        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
        </div>

        <div class="row justify-content-between">
            <div class="form-group col-lg-2 col-md-6">
                <label for="number_rooms">Numero di Stanze</label>
                <input type="number" name="number_rooms" id="number_rooms" cols="30" rows="10" class="form-control" placeholder="max: 20">
            </div>

            <div class="form-group col-lg-2 col-md-6">
                <label for="number_bathrooms">Numero di Bagni</label>
                <input type="number" name="number_bathrooms" id="number_bathrooms" cols="30" rows="10" class="form-control" placeholder="max: 20">
            </div>

            <div class="form-group col-lg-2 col-md-6">
                <label for="number_beds">Numero di Letti</label>
                <input type="number" name="number_beds" id="number_beds" cols="30" rows="10" class="form-control" placeholder="max: 20">
            </div>

            <div class="form-group col-lg-2 col-md-6">
                <label for="square_mts">Metri quadrati</label>
                <input type="number" name="square_mts" id="square_mts" cols="30" rows="10" class="form-control">
            </div>

            <div class="form-group col-lg-2 col-md-6">
                <label for="price_per_night">Prezzo per Notte</label>
                <input type="number" name="price_per_night" id="price_per_night" cols="30" rows="10" class="form-control">
            </div>
        </div>

        <div class="row check">
            <div class="form-group col-lg-3 col-md-6">
                <label for="check_in">check in</label>
                <select name="check_in" id="check_in" class="form-control">
                    <option value="" seletced> Scegli orario </option>
                    @for($i = 0; $i < 24; $i++) <option value="{{ $i }}"> {{ $i > 9 ? $i : '0' . $i }}:00 </option>
                        @endfor
                </select>
            </div>

            <div class="form-group col-lg-3 col-md-6">
                <label for="check_out">check out</label>
                <select name="check_out" id="check_out" class="form-control">
                    <option value="" seletced> Scegli orario </option>
                    @for($i = 0; $i < 24; $i++) <option value="{{ $i }}"> {{ $i }}:00 </option>
                        @endfor
                </select>
            </div>
        </div>




        {{-- services  --}}
        <div class="form-group">
            <strong>Aggiungi servizi</strong>
            <div class="row services">
                @foreach($services as $service)
                <div class="col-lg-4">
                    <label for="{{ $service->title }}">
                        <input type="checkbox" name="services[]" value="{{ $service->id }}" id="{{ $service->title }}">
                        {{ $service->title }}
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-3 col-md-6">
                <label for="country">Paese</label>
                <input type="text" name="country" id="country" cols="30" rows="10" class="form-control" />
            </div>

            <div class="form-group col-lg-3 col-md-6">
                <label for="city">Citta'</label>
                <input type="text" name="city" id="city" cols="30" rows="10" class="form-control" />
            </div>

            <div class="form-group col-lg-3 col-md-6">
                <label for="province">Provincia</label>
                <input type="text" name="province" id="province" cols="30" rows="10" class="form-control" />
            </div>

            <div class="form-group col-lg-3 col-md-6">
                <label for="zip">CAP</label>
                <input type="text" name="zip" id="zip" cols="30" rows="10" class="form-control" />
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-3">
                <label for="street_name">Tipo di via</label>
                <div class="type">
                    <select id="type_street" name="type_street" class="form-control">
                        <option value="via" selected>Via</option>
                        <option value="piazza">Piazza</option>
                        <option value="vicolo">Vicolo</option>
                    </select>
                </div>
            </div>


            <div class="form-group col-lg-3">
                <label for="street_name">Nome della via</label>
                <input type="text" name="street_name" id="street_name" cols="30" rows="10" class="form-control" />
            </div>

            <div class="form-group col-lg-3">
                <label for="building_number">Numero Civico</label>
                <input type="number" name="building_number" id="building_number" cols="30" rows="10" class="form-control" />
            </div>
        </div>

        <div class="form-group form-btn">
            <input id="newAccomodation" type="submit" value="CREA" class="form-control btn btn-success text-capitalize" />
        </div>
</div>



</form>
</div>


@endsection
