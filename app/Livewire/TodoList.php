<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;
    public string $name;
    public int $editId;
    public string $editName;
    public string $search = '';

    public function create()
    {
        $validated = $this->validate([
            'name' => 'required|min:2|max:50'
        ]);
        Todo::create($validated);
        $this->reset('name');
        session()->flash('created', __('Created.'));
        $this->resetPage();
    }
    public function render()
    {
        $todos = Todo::query()
            ->when($this->search, fn($q) => $q->where('name', 'LIKE', '%' . $this->search . '%'))
            ->latest()
            ->paginate(3);

        return view('livewire.todo-list', compact('todos'));
    }

    public function edit($id)
    {
        try {
            $todo = Todo::findOrFail($id);
            $this->editId = $id;
            $this->editName = $todo->name;
        }catch (\Exception $exception) {
            session()->flash('fail', __('There is no todo!'));
        }
    }

    public function update()
    {
        $todo = Todo::findOrFail($this->editId);
        $validated = $this->validate([
            'editName' => 'required|min:2|max:50'
        ]);
        $todo->update(['name' => $validated['editName']]);
        $this->cancelEdit();
        session()->flash('success', __('Updated Successfully.'));
    }

    public function cancelEdit(): void
    {
        $this->reset('editName', 'editId');
    }

    public function toggleCompleted($id): void
    {
        $todo = Todo::findOrFail($id);
        $todo->update(['is_completed' => !$todo->is_completed]);
        session()->flash('success', __(':Todo is :Action', ['todo' => $todo->name, 'action' => ['uncompleted', 'completed'][$todo->is_completed]]));
    }

    public function delete($id)
    {
        Todo::findOrFail($id)->delete();
        session()->flash('success', __('Deleted Successfully'));
    }

}
