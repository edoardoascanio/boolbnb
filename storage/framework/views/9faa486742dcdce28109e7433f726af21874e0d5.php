<?php if(count($errors->all()) > 0): ?> 
    <div style="
    
    margin-top: 20px;
    width: 400px;
    border-radius: 7px;
    border: 3px solid crimson;
    text-align: center;
    margin: auto;
    color: crimson;
    padding: 20px;
    
    
    ">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <p><?php echo e($error); ?></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>

<?php /**PATH C:\Users\asky_\OneDrive\Desktop\project\boolbnb\resources\views/layouts/components/error.blade.php ENDPATH**/ ?>