<x-filament-panels::page>
    <x-filament-forms::form wire:submit="save">
        {{ $this->form }}

        <div class="mt-6">
            <x-filament::button type="submit">
                Salvar
            </x-filament::button>
        </div>
    </x-filament-forms::form>
</x-filament-panels::page> 