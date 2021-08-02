@extends('layouts.app')

@section('content')
<section id="message">
    <div class="container">
        <div class="row justify-content-center">

            <div class="card col-10">
                <div class="card-body">

                    <div class="object">{{ $message->object_email }}</div>



                    <div class="mt-3">
                        <p>{{ $message->content }}</p>

                    </div>
                    <div class="details">
                        <h5 class="sender">{{ $message->email_sender }}</h5>
                        <p>{{ $message->created_at }}</p>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
@endsection
