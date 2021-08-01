@extends('logged.sponsorship.layouts')

@section('content')

<div class="container">
@if($sponsorActive)
   <h1> Il tuo appartamento è già sponsorizzato </h1>
@else
    <div id="sponsorships" class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="card col-12 col-lg-3">
                        <label class="form-check-label" for="1">
                            <div class="card-body">
                                <div class="form-check bnb-formCheck">
                                    <div class="color">
                                        <h5 class="bronze">Pacchetto Bronze</h5>
                                        <h6>Appartamento sponsorizzato per 24 ore</h6>
                                        <h6>2.99&#8364;</h6>
                                    </div>
                                    <input class="form-check-input sponsor-type bnb-sponsorType" checked type="radio"  name="sponsor-type" id="1" value="bronze">
                                </div>
                            </div>
                        </label>
                    </div>

                    <div class="card col-12 col-lg-3">
                        <label class="form-check-label" for="2">
                            <div class="card-body">
                                <div class="form-check bnb-formCheck">
                                    <div class="color">
                                        <h5 class="silver">Pacchetto Silver</h5>
                                        <h6>Appartamento sponsorizzato per 72 ore</h6>
                                        <h6>5.99&#8364;</h6>
                                    </div>
                                    <input class="form-check-input sponsor-type bnb-sponsorType" type="radio"  name="sponsor-type" id="2" value="silver">
                                </div>
                            </div>
                        </label>
                    </div>

                    <div class="card col-12 col-lg-3">
                        <label class="form-check-label" for="3">
                            <div class="card-body">
                                <div class="form-check bnb-formCheck">
                                    <div class="color">
                                        <h5 class="gold">Pacchetto Gold</h5>
                                        <h6>Appartamento sponsorizzato per 144 ore</h6>
                                        <h6>9.99&#8364;</h6>
                                    </div>
                                    <input class="form-check-input sponsor-type bnb-sponsorType" type="radio"  name="sponsor-type" id="3" value="gold">
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container bnb-totalMain">
        <div class="bnb-mainPayment">
            <div class="bnb-totalContainer">
                <div class="bnb-text col-md-8">
                    <h1>Sponsorizza il tuo appartamento!</h1>
                    <p>Sponsorizza ora il tuo appartamento e questo verrà mostrato per primo nella homepage o se corrisponde ad una ricerca!</p>
                </div>
            </div>
        </div>
        <div id="payment-container" class="disabled-payment">
            <div class="row">
                <div class="col-md-8">
                    <div id="dropin-container"></div>
                    <div class="d-flex">
                        <button class="btn btn-dark" id="submit-button">Invia Pagamento</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    var button = document.querySelector('#submit-button');
    var flat = {{ $id }};


    var radioButtons = document.getElementsByClassName('sponsor-type');
    for (let y = 0; y < radioButtons.length; y++) {
        radioButtons[y].addEventListener('click', function() {
            document.getElementById('payment-container').classList.remove('disabled-payment')
        })
    }
    var value;
    braintree.dropin.create({
            authorization: "{{ Braintree\ClientToken::generate() }}"
            , container: '#dropin-container'
            , translations: {
                payWithCard: 'Pagamento con Carta di Credito/Debito'
                , cardNumberLabel: 'Numero Carta'
                , expirationDateLabel: 'Data Di Scadenza'
                , expirationDateLabelSubheading: '(MM/AA)'
                , expirationDatePlaceholder: 'MM/AA'
                , fieldEmptyForNumber: 'Iserire il numero della carta.'
                , fieldInvalidForNumber: 'Il numero della carta non è valido.'
                , fieldEmptyForExpirationDate: 'Inserire la data di scadenza della carta.'
                , fieldInvalidForExpirationDate: 'La data di scadenza non è valida.'
                , hostedFieldsFieldsInvalidError: 'Per favore controlla i dati inseriti e riprova.'
            }
        },
        function(createErr, instance) {
            button.addEventListener('click', function() {
                for (let x = 0; x < radioButtons.length; x++) {
                    if (radioButtons[x].checked) {
                        value = radioButtons[x].value;
                    }
                }
                instance.requestPaymentMethod(function(err, payload) {
                    $.get('http://127.0.0.1:8000/payment/make', {
                            payload,
                            value,
                            flat
                        }, 
                        function(response) {
                            if (response.success) {
                                alert('Pagamento avvenuto con sucesso!');
                                window.location.replace('http://127.0.0.1:8000/logged/area-privata/' + {{ Auth::user()->id }})
                            } else {
                                alert('Transazione fallita, riprova piu tardi!');
                            }
                        }, 'json');
                });
            });
        });

</script>

@endif

@endsection
