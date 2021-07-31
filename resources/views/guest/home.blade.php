@extends('layouts.mapLayout')

@section('content')
<div class="container">
    
            <label for="city">Città</label>
            <input type="text" id="city" name="city">
            <label for="number_beds">Numero Letti</label>
            <input type="text" id="number_beds" name="number_beds">
            <div id="link">
            </div>
            
            <button onclick="search()">cerca</button>
       
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

