<?php
$mail = Auth::user() ? Auth::user()->email : '';
?>



<?php $__env->startSection('content'); ?>
<div class="container">

    <div class="container message-container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                <div class="card-header">
                <h3>Contatta il proprietario</h3>
                </div>

                    <div class="card-body">
                        <form method="post" action="<?php echo e(route('message.store', ['id' => $accomodation->id])); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="form-group row">
                                <label for="object_email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('oggetto della mail')); ?> <i class="fa fa-asterisk"></i></label>

                                <div class="col-md-6">
                                    <input id="object_email" type="text" class="form-control <?php $__errorArgs = ['object_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="object_email" readonly value="<?php echo e($accomodation->title . " - " . $accomodation->id); ?>" required autocomplete="name" autofocus> 

                                    <?php $__errorArgs = ['object_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email_sender" class="col-md-4 col-form-label text-md-right"><?php echo e(__('E-Mail Address')); ?> <i class="fa fa-asterisk"></i></label>

                                <div class="col-md-6">
                                    <input id="email_sender" type="email_sender" class="form-control <?php $__errorArgs = ['email_sender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email_sender" required autocomplete="email" value=<?php echo e(Auth::user() ? Auth::user()->email : ''); ?>>

                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="content" class="col-md-4 col-form-label text-md-right"><?php echo e(__('scrivi il tuo messaggio')); ?> <i class="fa fa-asterisk"></i></label>
                                <div class="col-md-6">
                                    <textarea name="content" id="content" cols="30" rows="10" class="form-control <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"></textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        <?php echo e(__('invia')); ?>

                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\asky_\OneDrive\Desktop\project\boolbnb\resources\views/message/create.blade.php ENDPATH**/ ?>