
<?php $__env->startSection('content'); ?>
<a class="btn blu-btn" id="blu-btn" href="<?php echo e(url()->previous()); ?>"><i style="color: white" class="fas fa-arrow-left"></i> Torna Indietro</a>


<div class="my-modal" id="my-modal" >
    <div class="modal-style" style="">
        <h3>Pagamento andato a buon fine!</h3>
        <button class="btn blu-btn" onclick="redirectMe()">Termina il pagamento</button>
    </div>
</div>

<div class="container">
<?php if($sponsorActive): ?>
   <h1> Il tuo appartamento è già sponsorizzato </h1>
<?php else: ?>
<div id="sponsorships" class="container">
<div class="col-md-8">
                        <div class="row">
                    <div class="card card-bronze col-12 col-lg-3">
                        <label class="form-check-label" for="1">
                            <div class="card-body">
                                <div class="form-check bnb-formCheck">
                                    <div class="color">
                                        <h5 class="bronze">Pacchetto Bronze</h5>
                                         <img src="<?php echo e(asset('imgs/badge-bronze.png')); ?>">
                                        <h6>Appartamento sponsorizzato per 24 ore</h6>
                                        <h6>2.99&#8364;</h6>
                                    </div>
                                    <input class="form-check-input sponsor-type bnb-sponsorType" checked type="radio"  name="sponsor-type" id="1" value="bronze">
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="card card-silver col-12 col-lg-3">
                        <label class="form-check-label" for="2">
                            <div class="card-body">
                                <div class="form-check bnb-formCheck">
                                    <div class="color">
                                        <h5 class="silver">Pacchetto Silver</h5>
                                        <img src="<?php echo e(asset('imgs/badge-silver.png')); ?>">
                                        <h6>Appartamento sponsorizzato per 72 ore</h6>
                                        <h6>5.99&#8364;</h6>
                                    </div>
                                    <input class="form-check-input sponsor-type bnb-sponsorType" type="radio"  name="sponsor-type" id="2" value="silver">
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="card card-gold col-12 col-lg-3">
                        <label class="form-check-label" for="3">
                            <div class="card-body">
                                <div class="form-check bnb-formCheck">
                                    <div class="color">
                                        <h5 class="gold">Pacchetto Gold</h5>
                                        <img src="<?php echo e(asset('imgs/badge-gold.png')); ?>">
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
    var flat = <?php echo e($id); ?>;
    var myModal = document.getElementById("my-modal")
    function redirectMe() {
        window.location.replace('http://127.0.0.1:8000/logged/area-privata/')
    }
    var radioButtons = document.getElementsByClassName('sponsor-type');
    for (let y = 0; y < radioButtons.length; y++) {
        radioButtons[y].addEventListener('click', function() {
            document.getElementById('payment-container').classList.remove('disabled-payment')
        })
    }
    var value;
    braintree.dropin.create({
            authorization: "<?php echo e(Braintree\ClientToken::generate()); ?>"
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
                                myModal.style.display = "block"
                            } else {
                                alert('Transazione fallita, riprova piu tardi!');
                            }
                        }, 'json');
                });
            });
        });
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('logged.sponsorship.layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\asky_\OneDrive\Desktop\project\boolbnb\resources\views/logged/sponsorship/create.blade.php ENDPATH**/ ?>