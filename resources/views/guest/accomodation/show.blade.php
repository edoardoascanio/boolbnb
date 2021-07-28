@extends('layouts.app')

@section('content')
<div class="container">
    <slider-images
    :id='{{$accomodation->id}}'
    ></slider-images>
    <h1>{{ $accomodation->title }}</h1>
    <h2>{{ $accomodation->description }}</h2>
    <h2>{{ $accomodation->city }} - {{ $accomodation->streat_name }} - {{ $accomodation->zip }}</h2>
    {{-- @if(isset(Auth::user()->id) && $accomodation->user_id != Auth::user()->id) --}}
    <a href="{{ route('message.create',['id' => $accomodation->id]) }}">contatta il proprietario</a>
    {{-- @endif --}}
</div>
@endsection
