@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('logged.create') }}">crea</a>
    <h1>ciao</h1>
    <h1>{{Auth::user()->name}}</h1>

    @foreach($accomodations as $accomodation)
    <div class="card" style="width: 18rem;">
        <div class="card-body">
    <img class="card-img" src="{{ $accomodation->placeholder ? asset('storage/' . $accomodation->placeholder) : asset('placeholder/house-placeholder.jpeg') }}" alt="..." class="img-thumbnail">

            <h5 class="card-title">{{ $accomodation->title }}</h5>
            <p class="card-text">{{ $accomodation->description }}</p>
            <div class="row">
                <div>

                    @foreach($accomodation->services as $service)
                    <span class="badge bg-secondary">{{ $service->title }}</span>
                    @endforeach
                </div>
            </div>

            <a href="{{ route('logged.show', ['id' => $accomodation->id]) }}" class="card-link btn btn-primary">Viasualizza</a><br>
            <a href="{{ route('logged.edit', $accomodation->id) }}" class="card-link btn btn-primary">Modifica</a><br>
            <a href="{{ route('logged.image.create', $accomodation->id) }}" class="card-link btn btn-primary">aggiungi img</a><br>
            @if(count($accomodation->messages) > 0)
            <a href="{{ route('message.index', $accomodation->id) }}" class="btn btn-primary">Hai {{ count($accomodation->messages) }} messaggi</a><br>
            @else
            <p>Non hai nessun messaggio</p>
            @endif
            <a href="{{ route('logged.sponsorship.create', $accomodation->id) }}" class="btn btn-primary">Sponsorizza</a><br>
            <form class="delete_form" action="{{ route('logged.destroy', $accomodation->id) }}" method="post">
                @csrf
                @method('DELETE')

                <input type="submit" value="Elimina">
            </form>
            <p>Visualizzazioni: {{ count($accomodation->views) }}</p>

            <form  action="{{ route('logged.visibility', $accomodation->id) }}" method="post">
                @csrf
                @method('PATCH')

                <label for="customSwitch1">Visibile
                    <input name="visibility" type="radio" value="1" id="true" {{ $accomodation->visibility == true ? 'checked' : "" }}>
                </label>

                <label for="customSwitch1">Non visibile
                    <input name="visibility" type="radio" value="0" id="false" {{ $accomodation->visibility == false ? 'checked' : "" }}>
                </label>

                <button type="submit">Applica
                </button>
            </form>
        </div>
    </div>


    @endforeach
</div>
@endsection
