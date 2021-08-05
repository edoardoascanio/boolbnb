

<?php $__env->startSection('content'); ?>
<div id="user-dashboard">
    <div class="container dash-container">
        <div class="card dash-card">
            <h3 class="dash-title">Dashboard di <?php echo e(Auth::user()->name); ?></h3>
            <a href="<?php echo e(route('logged.create')); ?>"> <i class="far fa-plus-square"></i> <strong>Crea</strong></a>
        </div>
        <div class="card rgba dash-body">
            <?php $__currentLoopData = $accomodations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accomodation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="accomodation-card">
                <div class="card card-body">
                    <h3 class="card-title"><?php echo e($accomodation->title); ?></h3>
                    <div class="row">
                        <div class="card-img col-lg-6">
                            <img src="<?php echo e($accomodation->placeholder ? asset('storage/' . $accomodation->placeholder) : asset('placeholder/house-placeholder.jpeg')); ?>">
                        </div>
                        <div class="col-lg-6">
                            <div class="prova">
                                <p class=""><?php echo e($accomodation->description); ?></p>
                                <div class="accomodation-btn">
                                    <a href="<?php echo e(route('logged.show', ['id' => $accomodation->id])); ?>" class="card-btn btn">Visualizza</a>
                                    
                                    
                                    
                                    <?php if($accomodation->sponsorActive): ?>
                                        <button class="card-btn btn danger">Già Sponsorizzato</button>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('logged.sponsorship.create', $accomodation->id)); ?>" class="card-btn btn">Sponsorizza</a><br>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\asky_\OneDrive\Desktop\project\boolbnb\resources\views/logged/user/dashboard.blade.php ENDPATH**/ ?>