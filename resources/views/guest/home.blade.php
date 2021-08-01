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

            {{-- <div class="city-img row">
                <form class="city-card col-md-3 col-sm-6">
                    <img src="{{asset('imgs/Roma.jpg')}}" alt="homepage">
            <div class="caption">
                <strong>Roma</strong>
            </div>
            </form>

            <div class="city-card col-md-3 col-sm-6">
                <a href=""><img src="{{asset('imgs/Milano.jpg')}}" alt="homepage"></a>
                <div class="caption">
                    <strong>Milano</strong>
                </div>
            </div>

            <div class="city-card col-md-3 col-sm-6">
                <a href=""><img src="{{asset('imgs/venezia.jpg')}}" alt="homepage"></a>
                <div class="caption">
                    <strong>Venezia</strong>
                </div>
            </div>

            <div class="city-card col-md-3 col-sm-6">
                <a href=""><img src="{{asset('imgs/firenze.jpg')}}" alt="homepage"></a>
                <div class="caption">
                    <strong>Firenze</strong>
                </div>
            </div>

        </div> --}}

        <div class="row justify-content-center">
            <a href="{{ route('guest.prova', ['city' => 'roma']) }}" class="col-md-3 col-sm-6 prova">
                <img src="{{asset('imgs/Roma.jpg')}}" alt="homepage">

                <div><strong id="caption">Roma</strong></div>
            </a>
            <a class="col-md-3 col-sm-6 prova">
                <img src="{{asset('imgs/Roma.jpg')}}" alt="homepage">

                <div><strong id="caption">Roma</strong></div>
            </a>
            <a class="col-md-3 col-sm-6 prova">
                <img src="{{asset('imgs/Roma.jpg')}}" alt="homepage">

                <div><strong id="caption">Roma</strong></div>
            </a>
            <a class="col-md-3 col-sm-6 prova">
                <img src="{{asset('imgs/Roma.jpg')}}" alt="homepage">

                <div><strong id="caption">Roma</strong></div>
            </a>
        </div>
</div>
</section>

<section class="house-type">
    <div class="container">
        <h3>Una casa per ogni tuo bisogno</h3>
        <p>Scegli case o stanze che più si addicono ai tuoi gusti e bisogni personali</p>

        <div class="type-content row">
            <div class="type-card col-md-4">
                <div class="type-img">
                    <img src="{{asset('imgs/casa-natura.jpg')}}" alt="homepage">
                    <div class="overlay"><i class="fa fa-home" aria-hidden="true"></i></div>
                </div>
                <div class="caption">
                    <strong>Soggiorni nella natura</strong>
                </div>
            </div>

            <div class="type-card col-md-4">
                <div class="type-img">
                    <img src="{{asset('imgs/casa-intera.jpg')}}" alt="homepage">
                    <div class="overlay"><i class="fa fa-home" aria-hidden="true"></i></div>
                </div>
                <div class="caption">
                    <strong>Case intere</strong>
                </div>
            </div>

            <div class="type-card col-md-4">
                <div class="type-img">
                    <img src="{{asset('imgs/hotel-room.jpg')}}" alt="homepage">
                    <div class="overlay"><i class="fa fa-home" aria-hidden="true"></i></div>
                </div>
                <div class="caption">
                    <strong>Hotel rooms</strong>
                </div>
            </div>

        </div>
    </div>
</section>


<section class="servicies">
    <div class="container">
        <h3>Servizi che potresti trovare </h3>

        <div class="row text-center">

            <div class="servicies-card col-lg-2 col-md-12 col-sm-12 col-xs-12">
                <i class="fa fa-cutlery" aria-hidden="true"></i>
                <p><strong>Cucina</strong></p>
            </div>

            <div class="servicies-card col-lg-2 col-md-12 col-sm-12 col-xs-12">
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
            </div>
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
