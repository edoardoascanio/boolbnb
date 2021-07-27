@extends('logged.sponsorship.layouts')

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

    {{-- braitree panel --}}

<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div id="dropin-container"></div>
        <button id="submit-button">Request payment method</button>
      </div>
    </div>
 </div>

</div>

<script>
   var button = document.querySelector('#submit-button');
   braintree.dropin.create({
     authorization: "sandbox_csbh27wt_vx4239rq6zqwk3gj",
     container: '#dropin-container'
   }, function (createErr, instance) {
     button.addEventListener('click', function () {
       instance.requestPaymentMethod(function (err, payload) {
         $.get('{{ route('payment.make') }}', {payload}, function (response) {
           if (response.success) {
             alert('Payment successfull!');
           } else {
             alert('Payment failed');
           }
         }, 'json');
       });
     });
   });
 </script>





@endsection


