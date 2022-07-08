<?php

namespace App\Http\Livewire;

use App\Models\Collection;
use App\Models\Todo;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Todos extends Component
{
   /**
    * The current collection.
    */
   public Collection $collection;

    /**
     * The current todos.
     *
     * @var Todo[]
     */
    public $todos;

    /**
     * The collection name.
     */
   public ?string $collection_name = null;

    /**
     * The id of the item which is being edited.
     */
    public ?int $item_editing = null;

    /**
     * The item name.
     */
    public ?string $item_name = null;

    /**
     * Is editing collection name.
     */
    public bool $is_editing_collection_name = false;

    /**
     * Mount the component.
     */
    public function mount(int $id): void
    {
        $collection = Collection::find($id);

        if (!$collection || $collection->user_id !== Auth::id()) {
            abort(404);
        }

        $this->collection = $collection;
        $this->collection_name = $this->collection->name;
        $this->todos = Todo::all()->where('collection_id', $this->collection->id);
    }

    /**
     * Add an item.
     */
    public function add(): void
    {
        Todo::create(['collection_id' => $this->collection->id]);
        $this->mount($this->collection->id);
    }

    /**
     * Edit collection name.
     */
    public function edit_collection_name(): void
    {
        $this->is_editing_collection_name = true;
    }

    /**
     * Save collection name.
     */
    public function save_collection_name(): void
    {
        $this->collection->name = $this->collection_name;
        $this->collection->save();
        $this->is_editing_collection_name = false;
    }

    /**
     * Edit item name.
     */
    public function edit_item_name(int $id): void
    {
        $todo = $this->todos->find($id);
        $this->item_name = $todo->name;
        $this->item_editing = $id;
    }

    /**
     * Save item name.
     */
    public function save_item_name(int $id): void
    {
        $todo = $this->todos->find($id);

        $todo->name = $this->item_name;
        $todo->save();

        $this->item_name = null;
        $this->item_editing = null;
    }

    /**
     * Delete item.
     */
    public function delete_item(int $id): void
    {
        $todo = $this->todos->find($id);
        $todo->delete();
        $this->mount($this->collection->id);
    }

    /**
     * Toggle item.
     */
    public function toggle_item(int $id, int $is_completed): void
    {
        $todo = $this->todos->find($id);
        $todo->is_completed = $is_completed;
        $todo->save();
    }

    /**
     * Render the component.
     */
    public function render(): View|Factory
    {
        return view('livewire.todos');
    }
}
