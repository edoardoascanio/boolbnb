<?php
$mail = Auth::user() ? Auth::user()->email : '';
?>

@extends('layouts.app')

@section('content')
<section id="create-img">


<div class="container">

    <div class="container message-container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                <div class="card-header">
                <h3>Contatta il proprietario</h3>
                </div>

                    <div class="card-body">
                        <form method="post" action="{{ route('message.store', ['id' => $accomodation->id]) }}">
                            @csrf

                            <div class="form-group row">
                                <label for="object_email" class="col-md-4 col-form-label text-md-right">{{ __('oggetto della mail') }} <i class="fa fa-asterisk"></i></label>

                                <div class="col-md-6">
                                    <input id="object_email" type="text" class="form-control @error('object_email') is-invalid @enderror" name="object_email" readonly value="{{ $accomodation->title . " - " . $accomodation->id }}" required autocomplete="name" autofocus>

                                    @error('object_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email_sender" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }} <i class="fa fa-asterisk"></i></label>

                                <div class="col-md-6">
                                    <input id="email_sender" type="email_sender" class="form-control @error('email_sender') is-invalid @enderror" name="email_sender" required autocomplete="email" value={{ Auth::user() ? Auth::user()->email : '' }}>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('scrivi il tuo messaggio') }} <i class="fa fa-asterisk"></i></label>
                                <div class="col-md-6">
                                    <textarea name="content" id="content" cols="30" rows="10" class="form-control @error('content') is-invalid @enderror"></textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('invia') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</section>
@endsection