<?php

namespace App\Http\Livewire\Department;

use App\Models\Department;
use Livewire\Component;

class DepartmentIndex extends Component
{
    public $name;
    public $departmentId;
    public $editMode = false;

    protected $rules = [
        'name' => 'required'
    ];

    public function storeDepartment()
    {
        $this->validate();

        Department::create([
            'name' => $this->name
        ]);

        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#departmentModal', 'actionModal' => 'hide']);
        session()->flash('department-message', 'Department successfully created');
    }
    
    public function showDepartment($id)
    {   
        $this->reset();
        $this->editMode = true;
        $this->departmentId = $id;

        $department = Department::find($this->departmentId);
        $this->name = $department->name;

        $this->dispatchBrowserEvent('modal', ['modalId' => '#departmentModal', 'actionModal' => 'show']);
    }

    public function updateDepartment()
    {
       $department = Department::find($this->departmentId);
        $department->update([
            'name' => $this->name 
        ]);

        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#departmentModal', 'actionModal' => 'hide']);
        session()->flash('department-message', 'Department successfully updated');
    }

    public function closeModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#departmentModal', 'actionModal' => 'hide']);
    }

    public function deleteDepartment($id)
    {
        Department::destroy($id);
    }

    public function render()
    {
        $departments = Department::all();

        return view('livewire.department.department-index', [
            'departments' => $departments
        ])->layout('layouts.main');
    }
}
