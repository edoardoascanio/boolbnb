@extends('layouts.app')

@section('content')
<div class="home-container">

    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="card col-lg-4 col-md-6 col-sm-12">
                    <div class="card-body">
                        <h1>Affitti per le tue vacanze</h1>
                        <p>Prenota un alloggio su Boolbnb</p>

                        <form action="{{ route('guest.map') }}" method="post">
                            @csrf
                            <input type="text" id="city" name="city" placeholder="Città">
                            <input type="text" id="number_beds" name="number_beds" placeholder="Numero Letti">
                            <button class="btn btn-primary search-btn blu-btn"> <i class="fa fa-search"></i> <strong>Cerca</strong></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="city">
        <div class="container">
            <h3>Le città del momento</h3>

            <div class="city-img row">
                <form action="{{ route('guest.map') }}" method="post" class="city-card">
                    @csrf
                    <img src="{{asset('imgs/Roma.jpg')}}" alt="homepage">
                    <input type="text" value="roma" name="city">
                    <input type="text" value="" name="number_beds">
                    <button type="submit">v</button>
                    <div class="caption">
                        <strong>Roma</strong>
                    </div>
                </form>
                <form action="{{ route('guest.map') }}" method="post" class="city-card">
                    @csrf
                    <img src="{{asset('imgs/Firenze.jpg')}}" alt="homepage">
                    <input type="text" value="Firenze" name="city">
                    <input type="text" value="" name="number_beds">
                    <button type="submit">v</button>
                    <div class="caption">
                        <strong>Firenze</strong>
                    </div>
                </form>
                <form action="{{ route('guest.map') }}" method="post" class="city-card">
                    @csrf
                    <img src="{{asset('imgs/Milano.jpg')}}" alt="homepage">
                    <input type="text" value="Milano" name="city">
                    <input type="text" value="" name="number_beds">
                    <button type="submit">v</button>
                    <div class="caption">
                        <strong>Milano</strong>
                    </div>
                </form>
                <form action="{{ route('guest.map') }}" method="post" class="city-card">
                    @csrf
                    <img src="{{asset('imgs/Venezia.jpg')}}" alt="homepage">
                    <input type="text" value="Venezia" name="city">
                    <input type="text" value="" name="number_beds">
                    <button type="submit">v</button>
                    <div class="caption">
                        <strong>Venezia</strong>
                    </div>
                </form>
            </div>
    </div>
</section>

@if(count($accomodations) > 0)
<section class="house-type">
    <div class="container">
        <h3>Appartamenti in vetrina</h3>
        <p>Affitti per le vacanze con le migliori valutazioni in tutta Italia</p>

        <div class="type-content row justify-content-between">

            @foreach($accomodations as $accomodation)

            <div class="type-card col-md-4">
                <div class="type-img">
                    <img src="{{ $accomodation->placeholder }}" alt="homepage">
                    <a class="overlay" href="{{ $accomodation->link }}">
                        <i class="fa fa-home" aria-hidden="true"></i>
                    </a>
                </div>
                <p class="text-capitalize">{{ $accomodation->city }} - {{ $accomodation->type_street}} {{ $accomodation->street_name}} {{ $accomodation->building_number}} </p> 
            </div>
                

            @endforeach
        </div>
    </div>
</section>
@endif


<section class="servicies">
    <div class="container">
        <h3>Servizi che potresti trovare </h3>

        <div class="row text-center justify-content-between">
            @foreach($services as $service)

            <div class="servicies-card col-lg-2 col-md-12 col-sm-12 col-xs-12">
                {!! $service->icon !!}
                <p class="text-capitalize"><strong>{{$service->title}}</strong></p>
            </div>
                
            @endforeach

            {{-- <div class="servicies-card col-lg-2 col-md-12 col-sm-12 col-xs-12">
                <i class="fa fa-wifi" aria-hidden="true"></i>
                <p><strong>Wi-fi</strong></p>
            </div>

            <div class="servicies-card col-lg-2 col-md-12 col-sm-12 col-xs-12">
                <i class="fa fa-bath" aria-hidden="true"></i>
                <p><strong>Piscina</strong></p>
            </div>

            <div class="servicies-card col-lg-2 col-md-12 col-sm-12 col-xs-12">
                <i class="fa fa-product-hunt" aria-hidden="true"></i>
                <p><strong>Parcheggio gratuito</strong></p>
            </div>

            <div class="servicies-card col-lg-2 col-md-12 col-sm-12 col-xs-12">
                <i class="fa fa-snowflake-o" aria-hidden="true"></i>
                <p><strong>Aria condizionata</strong></p>
            </div> --}}
        </div>
    </div>
</section>

<section class="register hidden-md">

    <div class="reg-img">
        <div class="container">
            <h1>Registrati</h1>
            <p><strong>Registrati su Boolbnb, per guadagnare <br> nuove opportunità e fare <br> piacevoli esperienze</strong></p>

            <a href="{{ route('register') }}"><button class="btn btn-primary reg-btn">Registrati</button></a>
        </div>
    </div>

</section>
</div>

@endsection
<script>
    function search() {

        $city = document.getElementById('city').value
        $number_beds = document.getElementById('number_beds')
        $link = document.getElementById('link')

        document.getElementById('link').innerHTML = "<a href='http://127.0.0.1:8000/guest/index?city=" + city + "'>Cerca</a>"
    }

</script>
