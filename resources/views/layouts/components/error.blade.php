@if(count($errors->all()) > 0) 
    <div style="
    
    margin-top: 20px;
    width: 400px;
    border-radius: 7px;
    border: 3px solid crimson;
    text-align: center;
    margin: auto;
    color: crimson;
    padding: 20px;
    
    
    ">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif

