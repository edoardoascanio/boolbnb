@extends('layouts.app')

@section('content')
<div class="container">



    <form action="{{ route('logged.sponsorship.store', ['id' => $id]) }}" method="post">
        @csrf
        @method('post')
        <div class="row">

            <div class="card">
                <h3>Bronze</h3>
                <ul>
                    <li>Prezzo: 2.99€</li>
                    <li>Durata 24H</li>
                </ul>
                <input type="radio" name="option" value="bronze">
            </div>
            <div class="card">
                <h3>Silver</h3>
                <ul>
                    <li>Prezzo: 4.99€</li>
                    <li>Durata 72H</li>
                </ul>
                <input type="radio" name="option" value="silver">

            </div>
            <div class="card">
                <h3>Gold</h3>
                <ul>
                    <li>Prezzo: 9.99€</li>
                    <li>Durata 144H</li>
                </ul>
                <input type="radio" name="option" value="gold">
            </div>
        </div>
        <button type="submit">Paga</button>
    </form>

</div>







@endsection
