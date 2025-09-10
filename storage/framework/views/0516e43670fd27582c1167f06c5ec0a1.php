<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'navigation',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'navigation',
]); ?>
<?php foreach (array_filter(([
    'navigation',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div
    <?php echo e($attributes->class(['fi-page-sub-navigation-sidebar-ctn hidden w-72 flex-col md:flex'])); ?>

>
    <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_SUB_NAVIGATION_SIDEBAR_BEFORE, scopes: $this->getRenderHookScopes())); ?>


    <ul
        wire:ignore
        class="fi-page-sub-navigation-sidebar flex flex-col gap-y-7"
    >
        <?php $__currentLoopData = $navigation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $navigationGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if (isset($component)) { $__componentOriginal59b772cc9788bdb14bf9872624b4f33a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal59b772cc9788bdb14bf9872624b4f33a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.sidebar.group','data' => ['active' => $navigationGroup->isActive(),'collapsible' => $navigationGroup->isCollapsible(),'icon' => $navigationGroup->getIcon(),'items' => $navigationGroup->getItems(),'label' => $navigationGroup->getLabel(),'sidebarCollapsible' => false,'subNavigation' => true,'attributes' => \Filament\Support\prepare_inherited_attributes($navigationGroup->getExtraSidebarAttributeBag())]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-panels::sidebar.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($navigationGroup->isActive()),'collapsible' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($navigationGroup->isCollapsible()),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($navigationGroup->getIcon()),'items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($navigationGroup->getItems()),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($navigationGroup->getLabel()),'sidebar-collapsible' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'sub-navigation' => true,'attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\prepare_inherited_attributes($navigationGroup->getExtraSidebarAttributeBag()))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal59b772cc9788bdb14bf9872624b4f33a)): ?>
<?php $attributes = $__attributesOriginal59b772cc9788bdb14bf9872624b4f33a; ?>
<?php unset($__attributesOriginal59b772cc9788bdb14bf9872624b4f33a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal59b772cc9788bdb14bf9872624b4f33a)): ?>
<?php $component = $__componentOriginal59b772cc9788bdb14bf9872624b4f33a; ?>
<?php unset($__componentOriginal59b772cc9788bdb14bf9872624b4f33a); ?>
<?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>

    <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_SUB_NAVIGATION_SIDEBAR_AFTER, scopes: $this->getRenderHookScopes())); ?>

</div>
<?php /**PATH D:\WindSurfProjects\raspadinha_29do7\vendor\filament\filament\resources\views\components\page\sub-navigation\sidebar.blade.php ENDPATH**/ ?>