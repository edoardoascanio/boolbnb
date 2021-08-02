@extends('layouts.app')

@section('content')
<div class="container">
    <section class="my-slider">
        <slider-images
        :id='{{$accomodation->id}}'
        ></slider-images>
    </section>

    <div class="row justify-content-center align-items-center">
        <div class="wrap col-12 col-md-10">
            <h3 class="title text-capitalize">{{ $accomodation->title }}</h3>
            <p class="city">
                <span class="text-capitalize">{{ $accomodation->city }} - {{ $accomodation->type_street}} {{ $accomodation->street_name}} {{ $accomodation->building_number}} - {{ $accomodation->zip }}</span> - {{ $accomodation->number_rooms }} stanza/e - {{ $accomodation->number_beds }} camera/e da letto - {{ $accomodation->number_bathrooms }} bagno/i</p>
            <p class="description text-justify">{{ $accomodation->description }}</p>
            <div class="line"></div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 py-4">
            <div class="padding-left">
                <i class="fas fa-home my_home"></i>
                <span class="padding-left">
                    Casa intera.
                    Appartamento: sarà a tua completa disposizione.
                </span>
            </div>
        </div>
        <div class="line"></div>
    </div> 


    @if(count($accomodation->services) > 0)
    <div class="row justify-content-center">
        <div class="col-12 col-md-10" >
            <div class="line"></div>
            <h3>Servizi disponibili</h3>
            <div class="row">
                @foreach($accomodation->services as $service)
                <div class="col-sm-6 col-md-4 col-lg-3 d-flex align-items-center mb-2">
                    <i class="fas fa-circle"></i>
                    <p class="my_badge text-capitalize mb-0">
                        {{ $service->title }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif


    {{-- <div class="row justify-content-center">
        <div class="col-12 col-md-10">
            <h3 class="text mb-5">Dove dormirai</h3>
            <div class="card_beds justify-content-center">
                <p>
                    <i class=" my-beds fas fa-bed"></i>
                    
                </p>
                Camera da letto: {{ $accomodation->number_beds }}
            </div>
        </div>
    </div> --}}


    <div class="row justify-content-center row-my-panel">

        <div class="col-12 col-md-10 ">
            <div class="my_actions">
            
                <a class="panel-item btn btn-primary"  href="{{ route('message.create',['id' => $accomodation->id]) }}">
                    <i class="far fa-envelope"></i>
                    Contatta il proprietario
                </a>
            </div>
               
        </div>
    </div>

  

    
</div>
@endsection
