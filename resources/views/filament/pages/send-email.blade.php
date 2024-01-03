<x-filament-panels::page>
    <x-filament-panels::form wire:submit="send">
        {{ $this->form }}
        <div>
        <x-filament::button type="submit" size="sm">
            Send
        </x-filament::button>
        </div>
    </x-filament-panels::form>
</x-filament-panels::page>