@extends('layouts.app')

@section('content')
<div class="container">
    <section class="my-slider">
        <slider-images :id='{{$accomodation->id}}'>
        </slider-images>
    </section>

    <div class="row row-my-panel">
        <div class="my-panel">
            {{-- image --}}
            <div class="my_actions">
                <a class="panel-item" href="{{ route('logged.image.create', $accomodation->id) }}">
                    <i class="fas fa-images"></i>
                </a>
            </div>
            {{-- edit --}}
            <div class="my_actions">
                <a class="panel-item" href="{{ route('logged.edit', $accomodation->id) }}">
                    <i class="fas fa-pencil-alt"></i>
                </a>
            </div>
            {{-- stat --}}
            <div class="my_actions">
                <a class="panel-item" href="{{ route('logged.stat', $accomodation->id) }}">
                    <i class="far fa-chart-bar"></i>
                </a>
            </div>
            {{-- messages --}}
            @if(count($accomodation->messages) > 0)
                <div class="my_actions">
                    <a class="panel-item" href="{{ route('message.index', $accomodation->id) }}" class="btn btn-primary">
                        <i class="far fa-envelope"></i>
                        <span class="notify">
                            {{ count($accomodation->messages) }}
                        </span>
                    </a>
                </div>
            @else
                <div class="my_actions">
                    <i class="fas fa-comment-slash panel-item"></i>
                </div>
            @endif
            {{-- views --}}
            @if(count($accomodation->views) > 0)
                <div class="my_actions panel-item no-effect">
                    <i class="far fa-eye"></i>
                    <span class="notify">
                        {{ count($accomodation->views) }}
                    </span>
                </div>
            @else
                <div class="my_actions panel-item no-effect">
                    <i class="far fa-eye-slash"></i>
                </div>
            @endif
            {{-- sponsorship --}}
            @if($accomodation->sponsorActive)
                <div class="my_actions panel-item no-effect sponsor">
                    <i class="fas fa-tag"></i>
                </div>
            @else
                <a class="panel-item" href="{{ route('logged.sponsorship.create', $accomodation->id) }}">
                    <i class="fas fa-tag"></i>
                </a>
            @endif
            {{-- delete --}}
            <form class="delete_form" action="{{ route('logged.destroy', $accomodation->id) }}" method="post">
                @csrf
                @method('DELETE')

                <button class="my_actions panel-item" type="submit">
                    <i class="far fa-trash-alt my-delete"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="row justify-content-center align-items-center">
        <div class="wrap col-12 col-md-10">
            <h1 class="title">{{ $accomodation->title }}</h1>
            <p class="city">{{ $accomodation->city }} - {{ $accomodation->zip }} - {{ $accomodation->number_rooms }} stanza/e - {{ $accomodation->number_beds }} camera/e da letto - {{ $accomodation->number_bathrooms }} bagno/i</p>
            <p class="description text-justify">{{ $accomodation->description }}</p>
            <div class="line"></div>
        </div>
    </div>

    <div class="row justify-content-center">
        <label for="tue">Visibile
            <input name="visibility" type="radio" value="1" id="true" {{ $accomodation->visibility == true ? 'checked' : "" }}>
        </label>
        <label for="false">Non visibile
            <input name="visibility" type="radio" value="0" id="false" {{ $accomodation->visibility == false ? 'checked' : "" }}>
        </label>
    </div>

    {{-- RIUTILIZZARE QUESTO PEZZO PER LA SHOW PUBBLICA --}}

    {{-- <div class="row justify-content-center">
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
    </div> --}}


    {{-- <div class="row justify-content-center">
        <div class="col-12 col-md-10">
            <h3 class="text-font">Dove dormirai</h3>
            <div>
                <p>
                    <i class=" my-beds fas fa-bed"></i>
                    Camera da letto: {{ $accomodation->number_beds }}
                </p>
            </div>
        </div>
    </div> --}}

    <div class="row justify-content-center">
        <div class="col-12 col-md-10" >
            <h3>Servizi disponibili</h3>
            <div class="row">
                @foreach($accomodation->services as $service)
                    <div class="col-sm-6 col-md-4 col-lg-3 d-flex align-items-center mb-2">
                        <i class="fas fa-circle"></i>
                        <h4 class="my_badge text-capitalize mb-0">
                            {{ $service->title }}
                        </h4>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

<script>

    function send() {
        document.getElementById('visibility-form').submit()
    }
    // or '.your_radio_class_name'
</script>