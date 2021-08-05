

<?php $__env->startSection('content'); ?>

<a class="btn blu-btn" id="blu-btn" href="<?php echo e(route('logged.dashboard')); ?>"><i style="color: white" class="fas fa-arrow-left"></i> Dashboard</a>
<div class="container">
    <section class="my-slider">
        <slider-images :id='<?php echo e($accomodation->id); ?>'>
        </slider-images>
    </section>

    <div class="row row-my-panel">
        <div class="my-panel">
            
            <div class="ah-boh">
                <div class="my_actions panel-item">
                    <a href="<?php echo e(route('logged.image.create', $accomodation->id)); ?>">
                        <i class="fas fa-images"></i>
                    </a>
                </div>
                <div class="ciao">Add img</div>
            </div>
            
            <div class="ah-boh">
                <div class="my_actions">
                    <a class="panel-item" href="<?php echo e(route('logged.edit', $accomodation->id)); ?>">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                </div>
                <div class="ciao">Edit</div>
            </div>
            
            <div class="ah-boh">
                <div class="my_actions">
                    <a class="panel-item" href="<?php echo e(route('logged.stat', $accomodation->id)); ?>">
                        <i class="far fa-chart-bar"></i>
                    </a>
                </div>
                <div class="ciao">Stats</div>
            </div>
            
            <?php if(count($accomodation->messages) > 0): ?>
                <div class="ah-boh">
                    <div class="my_actions">
                        <a class="panel-item btn btn-primary" href="<?php echo e(route('message.index', $accomodation->id)); ?>">
                            <i class="far fa-envelope"></i>
                            <span class="notify">
                                <?php echo e(count($accomodation->messages)); ?>

                            </span>
                        </a>
                    </div>
                    <div class="ciao">Mails</div>
                </div>
            <?php else: ?>
                <div class="ah-boh">
                    <div class="my_actions">
                        <i class="fas fa-comment-slash panel-item"></i>
                    </div>
                    <div class="ciao">Mails</div>
                </div>
            <?php endif; ?>
            
            <?php if($accomodation->sponsorActive): ?>
                <div class="ah-boh">
                    <div class="my_actions panel-item no-effect sponsor">
                        <i class="fas fa-tag"></i>
                    </div>
                    <div class="ciao">Sponsor</div>
                </div>
            <?php else: ?>
                <div class="ah-boh">
                    <a class="panel-item" href="<?php echo e(route('logged.sponsorship.create', $accomodation->id)); ?>">
                        <i class="fas fa-tag"></i>
                    </a>
                    <div class="ciao">Sponsor</div>
                </div>
            <?php endif; ?>
            
            <div class="ah-boh">
                <button id="btn-delete" class="my_actions panel-item">
                    <i class="far fa-trash-alt my-delete"></i>
                </button>
                <div class="ciao">Delete</div>
            </div>

            <div id="my-form-delete" class="my-modal modal-style">
                    <h3>Vuoi eliminare l'appartamento?</h3>
                    <div class="d-flex justify-content-around">
                        <button id="disable-delete" class="btn blu-btn">Annulla</button>
                        <form class="delete_form" action="<?php echo e(route('logged.destroy', $accomodation->id)); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn blu-btn" type="submit">Elimina</button>
                        </form>
                    </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center align-items-center">
        <div class="wrap col-12 col-md-10">
            <h3 class="title text-capitalize"><?php echo e($accomodation->title); ?></h3>
            <p class="city">
                <span class="text-capitalize"><?php echo e($accomodation->city); ?> - <?php echo e($accomodation->type_street); ?> <?php echo e($accomodation->street_name); ?> <?php echo e($accomodation->building_number); ?> - <?php echo e($accomodation->zip); ?></span> - <?php echo e($accomodation->number_rooms); ?> stanza/e - <?php echo e($accomodation->number_beds); ?> camera/e da letto - <?php echo e($accomodation->number_bathrooms); ?> bagno/i <br> Prezzo per Notte: <?php echo e($accomodation->price_per_night); ?>€</p>
            <p class="description text-justify"><?php echo e($accomodation->description); ?></p>
            <div class="line"></div>
        </div>
    </div>

    <div class="row justify-content-center my-visibility">
        <form action="<?php echo e(route('logged.visibility', $accomodation->id)); ?>" method="post" id="visibility-form">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>

            <h3 class="inline-block mr-1">Appartamento visibile:</h3>
            <div class="inline-block">
                <label for="true">Sì
                    <input name="visibility" type="radio" value="1" id="true" onchange="send()" <?php echo e($accomodation->visibility == true ? 'checked' : ""); ?>>
                </label>
                <label for="false">No
                    <input name="visibility" type="radio" value="0" id="false" onchange="send()" <?php echo e($accomodation->visibility == false ? 'checked' : ""); ?>>
                </label>
            </div>
        </form>
    </div>


    <?php if(count($accomodation->services) > 0): ?>
    <div class="row justify-content-center">
        <div class="col-12 col-md-10" >
            <div class="line"></div>
            <h3>Servizi disponibili</h3>
            <div class="row">
                <?php $__currentLoopData = $accomodation->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-6 col-md-4 col-lg-3 d-flex align-items-center mb-2">
                    
                    <p class="my_badge  mb-0">
                    <?php echo $service->icon; ?>

                        <span class="text-capitalize"><?php echo e($service->title); ?></span>
                    </p>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>

<script>

    function send() {
        document.getElementById('visibility-form').submit()
    }


    /* $(document).ready(function() {
        $('.my_actions.panel-item').click(function() {
            $('.my-form-delete').toggleClass('active');
        });
    }); */


    // or '.your_radio_class_name'
</script>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\asky_\OneDrive\Desktop\project\boolbnb\resources\views/logged/accomodation/show.blade.php ENDPATH**/ ?>