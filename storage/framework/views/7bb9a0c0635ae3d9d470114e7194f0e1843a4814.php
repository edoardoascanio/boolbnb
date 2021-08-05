

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.components.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<a class="btn blu-btn" id="blu-btn" href="<?php echo e(url()->previous()); ?>"><i style="color: white" class="fas fa-arrow-left"></i> Torna Indietro</a>

<div class="container create-container">

    <p> <i class="fa fa-asterisk"></i><span><em> <strong>Tutti i campi sono obbligatori</strong></em></p>


    <form action="<?php echo e(route("logged.update", $accomodation->id )); ?>" method="post" enctype="multipart/form-data">

        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="row">

            <div class="form-group title col-6">
                <label for="title">Titolo</label>
                <input type="text" id="title" name="title" class="form-control" value="<?php echo e($accomodation->title); ?>">
            </div>

            <div class="form-group load-img col-6">
                <label for="placeholder">Carica img di copertina</label><br>
                <input type="file" name="placeholder" id="placeholder" accept=".jpg, .png, .svg, .jpeg">
            </div>
        </div>

        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control"><?php echo e($accomodation->description); ?>"</textarea>
        </div>

        <div class="row justify-content-between">
            <div class="form-group col-lg-2 col-md-6">
                <label for="number_rooms">Numero di Stanze</label>
                <input type="number" name="number_rooms" id="number_rooms" cols="30" rows="10" class="form-control" placeholder="max: 20" value="<?php echo e($accomodation->number_rooms); ?>">
            </div>

            <div class="form-group col-lg-2 col-md-6">
                <label for="number_bathrooms">Numero di Bagni</label>
                <input type="number" name="number_bathrooms" id="number_bathrooms" cols="30" rows="10" class="form-control" placeholder="max: 20" value="<?php echo e($accomodation->number_bathrooms); ?>">
            </div>

            <div class="form-group col-lg-2 col-md-6">
                <label for="number_beds">Numero di Letti</label>
                <input type="number" name="number_beds" id="number_beds" cols="30" rows="10" class="form-control" placeholder="max: 20" value="<?php echo e($accomodation->number_beds); ?>">
            </div>

            <div class="form-group col-lg-2 col-md-6">
                <label for="square_mts">Metri quadrati</label>
                <input type="number" name="square_mts" id="square_mts" cols="30" rows="10" class="form-control" value="<?php echo e($accomodation->square_mts); ?>">
            </div>

            <div class="form-group col-lg-2 col-md-6">
                <label for="price_per_night">Prezzo per Notte</label>
                <input type="number" name="price_per_night" id="price_per_night" cols="30" rows="10" class="form-control" value="<?php echo e($accomodation->price_per_night); ?>">
            </div>
        </div>

        <div class="row check">
            <div class="form-group col-lg-3 col-md-6">
                <label for="check_in">check in</label>
                <select name="check_in" id="check_in" class="form-control">
                    <option value="" seletced> Scegli orario </option>
                    <?php for($i = 0; $i < 24; $i++): ?> <option value="<?php echo e($i); ?>" <?php echo e($i == $accomodation->check_in ? 'selected' : ""); ?>> <?php echo e($i); ?>:00 </option>
                        <?php endfor; ?>
                </select>
            </div>

            <div class="form-group col-lg-3 col-md-6">
                <label for="check_out">check out</label>
                <select name="check_out" id="check_out" class="form-control">
                    <option value="" seletced> Scegli orario </option>
                    <?php for($i = 0; $i < 24; $i++): ?> <option value="<?php echo e($i); ?>" <?php echo e($i == $accomodation->check_out ? 'selected' : ""); ?>> <?php echo e($i); ?>:00 </option>
                        <?php endfor; ?>
                </select>
            </div>
        </div>

        
        <div class="form-group">
            <strong>Aggiungi servizi</strong>
            <div class="row services">
                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4">
                    <label for="<?php echo e($service->title); ?>">
                        <input type="checkbox" name="services[]" value="<?php echo e($service->id); ?>" id="<?php echo e($service->title); ?>" <?php echo e($accomodation->services->contains($service) ? 'checked' : ''); ?>>
                        <?php echo e($service->title); ?>

                    </label>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-3 col-md-6">
                <label for="country">Paese</label>
                <input type="text" name="country" id="country" cols="30" rows="10" class="form-control" value="<?php echo e(old('country', $accomodation->country)); ?>" />
            </div>

            <div class="form-group col-lg-3 col-md-6">
                <label for="city">Citta'</label>
                <input type="text" name="city" id="city" cols="30" rows="10" class="form-control" value="<?php echo e(old('city', $accomodation->city)); ?>" />
            </div>

            <div class="form-group col-lg-3 col-md-6">
                <label for="province">Provincia</label>
                <input type="text" name="province" id="province" cols="30" rows="10" class="form-control" value="<?php echo e(old('province', $accomodation->province)); ?>" />
            </div>

            <div class="form-group col-lg-3 col-md-6">
                <label for="zip">CAP</label>
                <input type="text" name="zip" id="zip" cols="30" rows="10" class="form-control" value="<?php echo e(old('zip', $accomodation->zip)); ?>" />
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-3">
                <label for="street_name">Tipo di via</label>
                <div class="type">
                    <select id="type_street" name="type_street" class="form-control">
                        <option value="via" selected>Via</option>
                        <option value="piazza">Piazza</option>
                        <option value="vicolo">Vicolo</option>
                    </select>
                </div>
            </div>

            <div class="form-group col-lg-3">
                <label for="street_name">Nome della via</label>
                <input type="text" name="street_name" id="street_name" cols="30" rows="10" class="form-control" value="<?php echo e(old('street_name', $accomodation->street_name)); ?>" />
            </div>

            <div class="form-group col-lg-3">
                <label for="building_number">Numero Civico</label>
                <input type="number" name="building_number" id="building_number" cols="30" rows="10" class="form-control" value="<?php echo e(old('building_number', $accomodation->building_number)); ?>" />
            </div>
        </div>


        <div class="form-group form-btn">
            <input id="newAccomodation" type="submit" value="MODIFICA" class="form-control btn btn-success text-capitalize" />
        </div>
</div>

</form>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\asky_\OneDrive\Desktop\project\boolbnb\resources\views/logged/accomodation/edit.blade.php ENDPATH**/ ?>