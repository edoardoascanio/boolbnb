

<?php $__env->startSection('content'); ?>
<section id="message">
    <div class="container">
        <div class="row justify-content-center">

            <div class="card col-10">
                <div class="card-body">

                    <div class="object"><?php echo e($message->object_email); ?></div>



                    <div class="mt-3">
                        <p><?php echo e($message->content); ?></p>

                    </div>
                    <div class="details">
                        <h5 class="sender"><?php echo e($message->email_sender); ?></h5>
                        <p><?php echo e($message->created_at); ?></p>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\asky_\OneDrive\Desktop\project\boolbnb\resources\views/message/show.blade.php ENDPATH**/ ?>