<?php if (isset($component)) { $__componentOriginalbe23554f7bded3778895289146189db7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbe23554f7bded3778895289146189db7 = $attributes; } ?>
<?php $component = Filament\View\LegacyComponents\Page::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::page'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Filament\View\LegacyComponents\Page::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="flex flex-col items-center justify-center space-y-6">
        <!-- Título -->
        <h1 class="text-xl font-bold text-gray-700">
            Gerenciamento de Jogos e Provedores
        </h1>

        <!-- Botões de Controle -->
        <div class="space-y-4">
            <!-- Botão para Sincronizar Jogos e Provedores -->
            <button
                wire:click="syncGamesAndProviders"
                class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-lg shadow"
            >
                Importar Jogos e Provedores
            </button>

            <!-- Botão para Sincronizar Apenas Provedores -->
            <button
                wire:click="syncProvidersOnly"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow"
            >
                Importar Provedores
            </button>

            <!-- Botão para Sincronizar Apenas Jogos -->
            <button
                wire:click="syncGamesOnly"
                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-3 px-6 rounded-lg shadow"
            >
                Importar Jogos
            </button>

            <!-- Botão para Baixar Imagens -->
            <a
                href="https://imagensfivers.com/Dowload/Webp_Playfiver.zip"
                target="_blank"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow"
            >
                Baixar Imagens
            </a>

            <!-- Botão para Excluir Todos os Jogos e Provedores -->
            <button
                wire:click="deleteAllData"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg shadow"
            >
                Excluir Todos os Jogos e Provedores
            </button>




            <!-- Baixar e Extrair Imagens -->
            <button
                wire:click="downloadAndExtractZip"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow"
            >
                Baixar e Extrair Imagens
            </button>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbe23554f7bded3778895289146189db7)): ?>
<?php $attributes = $__attributesOriginalbe23554f7bded3778895289146189db7; ?>
<?php unset($__attributesOriginalbe23554f7bded3778895289146189db7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbe23554f7bded3778895289146189db7)): ?>
<?php $component = $__componentOriginalbe23554f7bded3778895289146189db7; ?>
<?php unset($__componentOriginalbe23554f7bded3778895289146189db7); ?>
<?php endif; ?>
<?php /**PATH D:\WindSurfProjects\raspadinha_29do7\resources\views\filament\pages\sync-games.blade.php ENDPATH**/ ?>