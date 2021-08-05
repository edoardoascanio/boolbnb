

<?php $__env->startSection('content'); ?>
<section id="messages">


<div class="container dash-container">
    <div class="card dash-card">
        <h3 class="dash-title">I tuoi messaggi</h3>
    </div>

    <div class="card dash-body container">
        <div class="row">
            <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="accomodation-card col-10 col-md-5">
                <div class="card card-body">
                    <h3 class="card-title"><?php echo e($message->object_email); ?></h3>
                    <p class=""><?php echo e($message->content); ?></p>
                    <div class="accomodation-btn">
                        <a href="<?php echo e(route('message.show', ['id' => $message->id])); ?>" class="card-btn btn">Visualizza</a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\asky_\OneDrive\Desktop\project\boolbnb\resources\views/message/index.blade.php ENDPATH**/ ?>