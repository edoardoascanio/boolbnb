

<?php $__env->startSection('content'); ?>
<div class="container">
    <section class="my-slider">
        <slider-images
        :id='<?php echo e($accomodation->id); ?>'
        ></slider-images>
    </section>

    <div class="row justify-content-center align-items-center">
        <div class="wrap col-12 col-md-10">
            <h3 class="title text-capitalize"><?php echo e($accomodation->title); ?></h3>
            <p class="city">
                <span class="text-capitalize"><?php echo e($accomodation->city); ?> - <?php echo e($accomodation->type_street); ?> <?php echo e($accomodation->street_name); ?> <?php echo e($accomodation->building_number); ?> - <?php echo e($accomodation->zip); ?></span> - <?php echo e($accomodation->number_rooms); ?> stanza/e - <?php echo e($accomodation->number_beds); ?> camera/e da letto - <?php echo e($accomodation->number_bathrooms); ?> bagno/i <br> Prezzo per Notte: <?php echo e($accomodation->price_per_night); ?>€<br> Proprietario/a: <?php echo e($user->name); ?></p>
            <p class="description text-justify"><?php echo e($accomodation->description); ?></p>
            <div class="line"></div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 py-4">
            <div class="padding-left">
                <i class="fas fa-home my_home"></i>
                <span class="padding-left">
                    Casa intera.
                    Appartamento: sarà a tua completa disposizione.
                </span>
            </div>
        </div>
        <div class="line"></div>
    </div>


    <?php if(count($accomodation->services) > 0): ?>
    <div class="row justify-content-center">
        <div class="col-12 col-md-10" >
            <div class="line"></div>
            <h3>Servizi disponibili</h3>
            <div class="row">
                <?php $__currentLoopData = $accomodation->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-6 col-md-4 col-lg-3 d-flex align-items-center mb-2">
                    <?php echo $service->icon; ?>

                    <p class="my_badge text-capitalize mb-0 ml-2 text-capitalize">
                        <?php echo e($service->title); ?>

                    </p>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>


    


    <div class="row justify-content-center row-my-panel">
        <div class="col-12 col-md-10 ">
            <div class="my_actions">
                <a class="panel-item btn btn-primary"  href="<?php echo e(route('message.create',['id' => $accomodation->id])); ?>">
                    <i class="far fa-envelope"></i>
                    Contatta il proprietario
                </a>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\asky_\OneDrive\Desktop\project\boolbnb\resources\views/guest/accomodation/show.blade.php ENDPATH**/ ?>