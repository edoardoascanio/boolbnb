@extends('layouts.app')

@section('content')
<div id="user-dashboard">
    <div class="container dash-container">
        <div class="card dash-card">
            <h3 class="dash-title">Dashboard di {{Auth::user()->name}}</h3>
            <a href="{{ route('logged.create') }}"> <i class="fa fa-plus-square-o"></i> <strong>Crea</strong></a>
        </div>
        <div class="card dash-body">
            @foreach($accomodations as $accomodation)
            <div class="accomodation-card">
                <div class="card card-body">
                    <h3 class="card-title">{{ $accomodation->title }}</h3>
                    <div class="row">
                        <img class="card-img col-lg-6" src="{{ $accomodation->placeholder ? asset('storage/' . $accomodation->placeholder) : asset('placeholder/house-placeholder.jpeg') }}" alt="..." class="img-thumbnail">
                        <div class="col-lg-6">
                            <div class="prova">
                                <p class="">{{ $accomodation->description }}</p>
                                <div class="accomodation-btn">
                                    <a href="{{ route('logged.show', ['id' => $accomodation->id]) }}" class="card-btn btn">Visualizza</a>
                                    {{-- @if(count($accomodation->messages) > 0) --}}
                                    {{-- <a href="{{ route('message.index', $accomodation->id) }}" class="card-btn btn btn-primary">Hai {{ count($accomodation->messages) }} Messaggi</a> --}}
                                    {{-- @else
                                    <p>Non hai nessun messaggio</p>
                                    @endif --}}
                                    @if($accomodation->sponsorActive)
                                        <button class="card-btn btn danger">Già Sponsorizzato</button>
                                    @else
                                        <a href="{{ route('logged.sponsorship.create', $accomodation->id) }}" class="card-btn btn">Sponsorizza</a><br>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
