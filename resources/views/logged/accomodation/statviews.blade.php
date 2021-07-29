@extends('logged.sponsorship.layouts')

@section('content')

<div class="container">
<button id="btn" onclick="#">messages</button>

    <div>
        <canvas id="myViews"></canvas>
    </div>
</div>


<script>
    const id = {{$id}}
    var views = null

    window.addEventListener('load', () => {    
        callViews()
    })



    function callViews() {
        axios.get('http://127.0.0.1:8000/api/stat/' + id)
            .then((resp) => {
                views = resp.data.views
                
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
                        label: 'Views',
                        backgroundColor: 'rgb(71, 110, 227)',
                        borderColor: 'rgb(71, 110, 227)',
                        data: views,
                        }]
                };

                const config = {
                    type: 'line',
                    data,
                    options: {}
                };
                var myChart = new Chart(
                    document.getElementById('myViews'),
                    config
                );
        })
    }
</script>
@endsection
