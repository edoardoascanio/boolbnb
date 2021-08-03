@extends('layouts.app')

@section('content')
<a class="btn blu-btn" id="blu-btn" href="{{ route('logged.show', [ 'id' => $id ] ) }}"><i style="color: white" class="fas fa-arrow-left"></i> Torna Indietro</a>

<section id="messages">


<div class="container dash-container">
    <div class="card dash-card">
        <h3 class="dash-title">I tuoi messaggi</h3>
    </div>

    <div class="card rgba dash-body container">
        <div class="row">
            @foreach($messages as $message)
            <div class="accomodation-card col-11 col-md-8">
                <div class="card card-body">
                    <h3 class="card-title">{{ $message->object_email }}</h3>
                    <p class="">{{ $message->content }}</p>
                    <div class="accomodation-btn">
                        <a href="{{ route('message.show', ['id' => $message->id]) }}" class="card-btn btn">Visualizza</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</section>

@endsection
