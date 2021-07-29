@extends('logged.sponsorship.layouts')

@section('content')

<div class="container">


    <div>
        <canvas id="myMessage"></canvas>
    </div>
</div>


<script>
    const id = {{$id}}
    var messages = null

    window.addEventListener('load', () => {    
        callMessages()
    })



    function callMessages() {
        axios.get('http://127.0.0.1:8000/api/stat/' + id)
            .then((resp) => {
                messages = resp.data.messages
                
                const labelsV = [
                'Gennaio',
                'Febbriao',
                'Marzo',
                'Aprile',
                'Maggio',
                'Giugno',
                'Luglio',
                ];

                const data = {
                    labels: labelsV,

                    datasets: [{
                        label: 'Messages',
                        backgroundColor: 'rgb(71, 110, 227)',
                        borderColor: 'rgb(71, 110, 227)',
                        data: messages,
                        }]
                };

                const config = {
                    type: 'line',
                    data,
                    options: {}
                };
                var myChart = new Chart(
                    document.getElementById('myMessage'),
                    config
                );
        })
    }
</script>
@endsection
