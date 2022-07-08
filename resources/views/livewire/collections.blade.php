<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tadas') }}
            </h2>
        </div>
    </header>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                @foreach ($collections as $collection)
                    <div class="flex justify-between w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                        <a href="{{ route('tada', ['id' => $collection->id]) }}">
                            {{ $collection->name ?? __('Untitled List') }}
                        </a>
                        <button wire:click="delete({{ $collection->id }})" class="block w-6 mr-2">
                            <x-heroicon-o-trash />
                        </button>
                    </div>
                @endforeach

                <x-button wire:click="add" class="mt-8">
                    {{ __('Add') }}
                </x-button>
            </div>
        </div>
    </div>
</div>
