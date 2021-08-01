@extends('layouts.app')

@section('content')
<section class="form-container">
    <div class="container">

        <div class="form-img">
            <div class="card">
                <div class="card-header">
                    <strong>Inserisci un'immagine</strong>
                </div>
                <div class="card-body">
                    <form action="{{ route('logged.image.store', $id) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <input type="file" name="cover_url">
                        </div>
                        <div class="form-group">
                            <label for="alt">Descrizione img</label>
                            <input type="text" name="alt" id="alt">
                        </div>

                        <input type="submit" class="btn btn-primary img-btn" value="INVIA">

                    </form>
                </div>
            </div>
        </div>
</section>

</div>
@endsection
