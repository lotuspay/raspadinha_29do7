<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'sidebar',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'sidebar',
]); ?>
<?php foreach (array_filter(([
    'sidebar',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div class="mt-8">
    <nav class="flex items-center gap-x-2 bg-white px-4 py-2 rounded-md dark:bg-gray-900 dark:ring-white/10 md:px-4 lg:px-4 overflow-x-scroll">
        <?php if($sidebar->getTitle() != null || $sidebar->getDescription() != null): ?>
            <div class="me-6 hidden lg:flex flex-col">
                <h3 class="text-base font-medium text-slate-700 dark:text-white truncate block">
                    <?php echo e($sidebar->getTitle()); ?>

                </h3>
                <p class="text-xs text-gray-400 flex items-center gap-x-1">
                    <?php echo e($sidebar->getDescription()); ?>

                </p>
            </div>
        <?php endif; ?>

        <?php if(count($sidebar->getNavigationItems())): ?>
            <ul class="flex items-center gap-x-4">
                <?php $__currentLoopData = $sidebar->getNavigationItems(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($groupLabel = $group->getLabel()): ?>
                        <?php if (isset($component)) { $__componentOriginal22ab0dbc2c6619d5954111bba06f01db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal22ab0dbc2c6619d5954111bba06f01db = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.index','data' => ['placement' => 'bottom-start','teleport' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placement' => 'bottom-start','teleport' => true]); ?>
                             <?php $__env->slot('trigger', null, []); ?> 
                                <?php if (isset($component)) { $__componentOriginal42035aa49c877d648231e14ff76681c7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42035aa49c877d648231e14ff76681c7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.topbar.item','data' => ['active' => $group->isActive(),'icon' => $group->getIcon()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-panels::topbar.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($group->isActive()),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($group->getIcon())]); ?>
                                    <?php echo e($groupLabel); ?>

                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal42035aa49c877d648231e14ff76681c7)): ?>
<?php $attributes = $__attributesOriginal42035aa49c877d648231e14ff76681c7; ?>
<?php unset($__attributesOriginal42035aa49c877d648231e14ff76681c7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal42035aa49c877d648231e14ff76681c7)): ?>
<?php $component = $__componentOriginal42035aa49c877d648231e14ff76681c7; ?>
<?php unset($__componentOriginal42035aa49c877d648231e14ff76681c7); ?>
<?php endif; ?>
                             <?php $__env->endSlot(); ?>

                            <?php if (isset($component)) { $__componentOriginal66687bf0670b9e16f61e667468dc8983 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66687bf0670b9e16f61e667468dc8983 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.list.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::dropdown.list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                <?php $__currentLoopData = $group->getItems(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $icon = $item->getIcon();
                                        $shouldOpenUrlInNewTab = $item->shouldOpenUrlInNewTab();
                                    ?>

                                    <?php if (isset($component)) { $__componentOriginal1bd4d8e254cc40cdb05bd99df3e63f78 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1bd4d8e254cc40cdb05bd99df3e63f78 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.list.item','data' => ['badge' => $item->getBadge(),'badgeColor' => $item->getBadgeColor(),'href' => $item->getUrl(),'icon' => $item->isActive() ? ($item->getActiveIcon() ?? $icon) : $icon,'tag' => 'a','target' => $shouldOpenUrlInNewTab ? '_blank' : null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::dropdown.list.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['badge' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->getBadge()),'badge-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->getBadgeColor()),'href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->getUrl()),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->isActive() ? ($item->getActiveIcon() ?? $icon) : $icon),'tag' => 'a','target' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($shouldOpenUrlInNewTab ? '_blank' : null)]); ?>
                                        <?php echo e($item->getLabel()); ?>

                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1bd4d8e254cc40cdb05bd99df3e63f78)): ?>
<?php $attributes = $__attributesOriginal1bd4d8e254cc40cdb05bd99df3e63f78; ?>
<?php unset($__attributesOriginal1bd4d8e254cc40cdb05bd99df3e63f78); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1bd4d8e254cc40cdb05bd99df3e63f78)): ?>
<?php $component = $__componentOriginal1bd4d8e254cc40cdb05bd99df3e63f78; ?>
<?php unset($__componentOriginal1bd4d8e254cc40cdb05bd99df3e63f78); ?>
<?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal66687bf0670b9e16f61e667468dc8983)): ?>
<?php $attributes = $__attributesOriginal66687bf0670b9e16f61e667468dc8983; ?>
<?php unset($__attributesOriginal66687bf0670b9e16f61e667468dc8983); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal66687bf0670b9e16f61e667468dc8983)): ?>
<?php $component = $__componentOriginal66687bf0670b9e16f61e667468dc8983; ?>
<?php unset($__componentOriginal66687bf0670b9e16f61e667468dc8983); ?>
<?php endif; ?>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal22ab0dbc2c6619d5954111bba06f01db)): ?>
<?php $attributes = $__attributesOriginal22ab0dbc2c6619d5954111bba06f01db; ?>
<?php unset($__attributesOriginal22ab0dbc2c6619d5954111bba06f01db); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal22ab0dbc2c6619d5954111bba06f01db)): ?>
<?php $component = $__componentOriginal22ab0dbc2c6619d5954111bba06f01db; ?>
<?php unset($__componentOriginal22ab0dbc2c6619d5954111bba06f01db); ?>
<?php endif; ?>
                    <?php else: ?>
                        <?php $__currentLoopData = $group->getItems(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (isset($component)) { $__componentOriginalbbba56dde4ad2b529f55ffd80b5f25d0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbbba56dde4ad2b529f55ffd80b5f25d0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-page-with-sidebar::components.topbar.item','data' => ['active' => $item->isActive(),'activeIcon' => $item->getActiveIcon(),'badge' => $item->getBadge(),'badgeColor' => $item->getBadgeColor(),'icon' => $item->getIcon(),'shouldOpenUrlInNewTab' => $item->shouldOpenUrlInNewTab(),'url' => $item->getUrl()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-page-with-sidebar::topbar.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->isActive()),'active-icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->getActiveIcon()),'badge' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->getBadge()),'badge-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->getBadgeColor()),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->getIcon()),'should-open-url-in-new-tab' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->shouldOpenUrlInNewTab()),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->getUrl())]); ?>
                                <?php echo e($item->getLabel()); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbbba56dde4ad2b529f55ffd80b5f25d0)): ?>
<?php $attributes = $__attributesOriginalbbba56dde4ad2b529f55ffd80b5f25d0; ?>
<?php unset($__attributesOriginalbbba56dde4ad2b529f55ffd80b5f25d0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbbba56dde4ad2b529f55ffd80b5f25d0)): ?>
<?php $component = $__componentOriginalbbba56dde4ad2b529f55ffd80b5f25d0; ?>
<?php unset($__componentOriginalbbba56dde4ad2b529f55ffd80b5f25d0); ?>
<?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
    </nav>
</div><?php /**PATH D:\WindSurfProjects\raspadinha_29do7\vendor\aymanalhattami\filament-page-with-sidebar\resources\views\components\topbar\index.blade.php ENDPATH**/ ?>