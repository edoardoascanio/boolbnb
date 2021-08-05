



<?php $__env->startSection('content'); ?>

<div class="stat-container">

    <div class="container">
        <div class="card-header">
        <h3>Le mie statistiche</h3>
        </div>
        <div class="card stat-card">
            <div class="row">
                <div class="col-12 col-md-6">
                    <canvas id="myViews"></canvas>
                </div>
                <div class="col-12 col-md-6">
                    <canvas id="myMessages"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    const id = <?php echo e($id); ?>

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
                        backgroundColor: '#71a8cd',
                        borderColor: '#71a8cd',
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
                        backgroundColor: '#71a8cd',
                        borderColor: '#71a8cd',
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('logged.sponsorship.layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\asky_\OneDrive\Desktop\project\boolbnb\resources\views/logged/accomodation/stat.blade.php ENDPATH**/ ?>