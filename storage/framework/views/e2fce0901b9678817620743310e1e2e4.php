<div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flex justify-between items-center">
                <span class="text-sm font-medium text-gray-300"><?php echo e($label); ?>:</span>
                <span class="text-sm text-white font-semibold"><?php echo e($value); ?></span>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div> <?php /**PATH D:\WindSurfProjects\raspadinha_29do7\resources\views\filament\components\info-table.blade.php ENDPATH**/ ?>