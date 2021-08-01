@extends('logged.sponsorship.layouts')

@section('content')

<div class="container">
@if($sponsorActive)
   <h1> Il tuo appartamento è già sponsorizzato </h1>
@else
    <div class="row">
        <div class="form-check bnb-formCheck">
            <input class="form-check-input sponsor-type bnb-sponsorType" checked type="radio"  name="sponsor-type" id="1" value="bronze">
            <label class="form-check-label" for="sponsor-type">
                Pacchetto Bronzo
            </label>
        </div>
        <div class="form-check bnb-formCheck">
            <input class="form-check-input sponsor-type bnb-sponsorType" type="radio"  name="sponsor-type" id="2" value="silver">
            <label class="form-check-label" for="sponsor-type">
                Pacchetto silver
            </label>
        </div>
        <div class="form-check bnb-formCheck">
            <input class="form-check-input sponsor-type bnb-sponsorType" type="radio"  name="sponsor-type" id="3" value="gold">
            <label class="form-check-label" for="sponsor-type">
                Pacchetto Oro
            </label>
        </div>

    </div>

    <div class="container bnb-totalMain">

        <div class="bnb-mainPayment">
            <div class="container bnb-totalContainer">
                <div class="bnb-text">
                    <h1>Sponsorizza il tuo appartamento!</h1>
                    <p>
                        Sponsorizza ora il tuo appartamento e questo verrà mostrato per primo nella homepage o se corrisponde ad una
                        ricerca!
                    </p>
                </div>

                @php
                /* if (count($flat->sponsor) > 0) {
                $sponsorEnd = $flat->sponsor[count($flat->sponsor) - 1]->sponsor_end;
                if($sponsorEnd > date("Y-m-d H:i:s")){
                $sponsorActiveFlag = true;
                }else {
                $sponsorActiveFlag = false;
                }
                }else{
                $sponsorEnd = 0;
                $sponsorActiveFlag = false;
                } */
                @endphp


                {{--@if (!$sponsorActiveFlag)
        @foreach ($sponsorTypes as $sponsorType)
        <div class="form-check bnb-formCheck">
            <input class="form-check-input sponsor-type bnb-sponsorType" type="radio" v-on:click="changeFlag()" name="sponsor-type" id="sponsor-type{{ $sponsorType->id }}" value="{{ $sponsorType->id }}">
                <label class="form-check-label" for="sponsor-type">
                    Pacchetto {{ $sponsorType->sponsor_name }}: &nbsp; Durata della sponsorizzazione: {{ $sponsorType->sponsor_duration }}/h &nbsp;&nbsp; Prezzo:
                    {{ $sponsorType->sponsor_price }} &euro;
                </label>
            </div>
            @endforeach
            @endif

            @if ($sponsorActiveFlag)
            <h2 class="advertice">Questo appartamento ha già una sponsorizzazione attiva in scadenza il {{$sponsorEnd}}</h2>
            @endif
            --}}

        </div>
    </div>
    {{-- container pagamento --}}
    <div id="payment-container" class="container disabled-payment">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div id="dropin-container"></div>
                <button class="btn btn-dark" id="submit-button">Invia Pagamento</button>
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
                                window.location.replace('http://127.0.0.1:8000/logged/area-privata')
                            } else {
                                alert('Transazione fallita, riprova piu tardi!');
                            }
                        }, 'json');
                });
            });
        });

</script>


</div>

@endif


@endsection
