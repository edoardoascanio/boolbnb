@extends('logged.sponsorship.layouts')

@section('content')

<div class="container">

<div class="row">
    <div class="col-6">
        <canvas id="myViews"></canvas>
    </div>

    <div class="col-6">
        <canvas id="myMessages"></canvas>
    </div>

</div>
    
</div>

<script>
    const id = {{$id}}
    var views = null
    var messages = null

    window.addEventListener('load', () => {    
        callViews()
        callMessages()
    })

    function callViews() {
        axios.get('http://127.0.0.1:8000/api/stat/' + id)
            .then((resp) => {
                views = resp.data.views
                
                const labelsV = [
                'Gen',
                'Feb',
                'Mar',
                'Apr',
                'Mag',
                'Giu',
                'Lug',
                'Ago',
                'Set',
                'Ott',
                'Nov',
                'Dic',
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
                    options: {
                        scales: {
                            y: {
                                title: {
                                display: true,
                                text: 'Value'
                                },
                                min: 0,
                                max: 20,
                                ticks: {
                                // forces step size to be 50 units
                                stepSize: 1
                                
                                }
                            }
                        }
                    }
                }

                var myChart = new Chart(
                    document.getElementById('myViews'),
                    config
                    )
                
        });
    }

    function callMessages() {
        axios.get('http://127.0.0.1:8000/api/stat/' + id)
            .then((resp) => {
                messages = resp.data.messages
                
                const labelsV = [
                'Gen',
                'Feb',
                'Mar',
                'Apr',
                'Mag',
                'Giu',
                'Lug',
                'Ago',
                'Set',
                'Ott',
                'Nov',
                'Dic',
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
                    options: {
                        scales: {
                            y: {
                                title: {
                                display: true,
                                text: 'Value'
                                },
                                min: 0,
                                max: 20,
                                ticks: {
                                // forces step size to be 50 units
                                stepSize: 1
                                
                                }
                            }
                        }
                    }
                };
                var myChart = new Chart(
                    document.getElementById('myMessages'),
                    config
                );
        })
    }
    
</script>
@endsection
