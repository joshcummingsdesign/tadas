<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex">
                <a href="{{ route('tadas') }}" class="block w-6 mr-2">
                    <x-heroicon-o-arrow-left />
                </a>
                @if ($is_editing_collection_name)
                    <input class="font-semibold text-xl text-gray-800 leading-tight"
                        wire:model="collection_name"
                        wire:keydown.enter="save_collection_name"
                        type="text" />
                @else
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight"
                        wire:click="edit_collection_name">
                        {{ $collection->name ?? __('Untitled List') }}
                    </h2>
                 @endif
            </div>
        </div>
    </header>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                @foreach ($todos as $todo)
                    @if ($item_editing === $todo->id)
                        <input class="block w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
                           wire:model="item_name"
                           wire:keydown.enter="save_item_name({{ $todo->id }})"
                           type="text" />
                    @else
                        <div class="flex justify-between w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                            <span wire:click="edit_item_name({{ $todo->id }})">
                                {{ $todo->name ?? __('Untitled Item') }}
                            </span>
                            <div class="flex">
                                <button wire:click="toggle_item({{ $todo->id }}, {{ 1 - $todo->is_completed }})" class="block w-6 mr-2">
                                    @if ($todo->is_completed)
                                        <x-heroicon-s-check-circle />
                                    @else
                                        <x-heroicon-o-check-circle />
                                    @endif
                                </button>
                                <button wire:click="delete_item({{ $todo->id }})" class="block w-6 mr-2">
                                    <x-heroicon-o-trash />
                                </button>
                            </div>
                        </div>
                    @endif
                @endforeach

                <x-button wire:click="add" class="mt-8">
                    {{ __('Add') }}
                </x-button>
            </div>
        </div>
    </div>
</div>
