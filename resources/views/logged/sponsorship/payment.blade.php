@extends('layouts.app')

@section('content')

<h1>pagamento appartamento id = {{ $id }}</h1>




<form action="{{ route('logged.sponsorship.store', ['id' => $id]) }}" method="post">
@csrf
@method('post')

@foreach($sponsorships as $sponsorship)
<ul>
<li>{{ $sponsorship->title }}</li>
<li>{{ $sponsorship->duration }} h</li>
<li>{{ $sponsorship->price }} €</li>
<input type="radio" value="{{ $sponsorship->id }}" name="sponsorhip">
</ul>

    
@endforeach

<button>paga</button>
</form>

@endsection
