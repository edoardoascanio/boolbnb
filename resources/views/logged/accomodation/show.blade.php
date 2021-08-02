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
                    <a class="panel-item btn btn-primary" href="{{ route('message.index', $accomodation->id) }}">
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
            <h3 class="title text-capitalize">{{ $accomodation->title }}</h3>
            <p class="city">
                <span class="text-capitalize">{{ $accomodation->city }} - {{ $accomodation->type_street}} {{ $accomodation->street_name}} {{ $accomodation->building_number}} - {{ $accomodation->zip }}</span> - {{ $accomodation->number_rooms }} stanza/e - {{ $accomodation->number_beds }} camera/e da letto - {{ $accomodation->number_bathrooms }} bagno/i</p>
            <p class="description text-justify">{{ $accomodation->description }}</p>
            <div class="line"></div>
        </div>
    </div>

    <div class="row justify-content-center my-visibility">
        <form action="{{ route('logged.visibility', $accomodation->id) }}" method="post" id="visibility-form">
            @csrf
            @method('PATCH')

            <h3 class="inline-block mr-1">Visibility:</h3>
            <div class="inline-block">
                <label for="true">Sì
                    <input name="visibility" type="radio" value="1" id="true" onchange="send()" {{ $accomodation->visibility == true ? 'checked' : "" }}>
                </label>
                <label for="false">No
                    <input name="visibility" type="radio" value="0" id="false" onchange="send()" {{ $accomodation->visibility == false ? 'checked' : "" }}>
                </label>
            </div>
        </form>
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
</div>

@endsection

<script>

    function send() {
        document.getElementById('visibility-form').submit()
    }
    // or '.your_radio_class_name'
</script>