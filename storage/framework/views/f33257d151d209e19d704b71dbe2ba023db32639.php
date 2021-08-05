

<?php $__env->startSection('content'); ?>
<section class="form-container">
<a class="btn blu-btn" id="blu-btn" href="<?php echo e(url()->previous()); ?>"><i style="color: white" class="fas fa-arrow-left"></i> Torna Indietro</a>

    <div class="container">

        <div class="form-img">
            <div class="card">
                <div class="card-header">
                    <strong>Inserisci un'immagine</strong>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('logged.image.store', $id)); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="form-group">
                            <input type="file" name="cover_url">
                        </div>
                        <div class="form-group">
                            <label for="alt">Descrizione img</label>
                            <input type="text" name="alt" id="alt">
                        </div>

                        <input type="submit" class="btn btn-primary img-btn" value="INVIA">

                    </form>
                </div>
            </div>
        </div>
</section>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\asky_\OneDrive\Desktop\project\boolbnb\resources\views/logged/accomodation/image.blade.php ENDPATH**/ ?>