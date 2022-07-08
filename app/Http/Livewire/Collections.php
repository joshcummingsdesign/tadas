<?php

namespace App\Http\Livewire;

use App\Models\Collection;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Collections extends Component
{
    /**
     * Add a collection.
     */
    public function add(): void
    {
        Collection::create(['user_id' => Auth::id()]);
    }

    /**
     * Delete a collection.
     */
    public function delete(int $id): void
    {
        Collection::find($id)->delete();
    }

    /**
     * Render the component.
     */
    public function render(): View|Factory
    {
        return view('livewire.collections', [
            'collections' => Collection::all()->where('user_id', Auth::id()),
        ]);
    }
}
