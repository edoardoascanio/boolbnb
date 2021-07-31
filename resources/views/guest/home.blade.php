@extends('layouts.mapLayout')

@section('content')
<div class="container">








    <form action="{{ route('guest.map') }}" method="post">
        @csrf
        <label for="city">Città</label>
        <input type="text" id="city" name="city">
        <label for="number_beds">Numero Letti</label>
        <input type="text" id="number_beds" name="number_beds">
        <button>cerca</button>

    </form>




</div>
@endsection
