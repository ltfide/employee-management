<?php

namespace App\Http\Livewire\Employee;

use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\Employee;
use App\Models\State;
use Livewire\Component;

class EmployeeIndex extends Component
{
    public $lastName;
    public $firstName;
    public $middleName;
    public $address;
    public $departmentId;
    public $countryId;
    public $stateId;
    public $cityId;
    public $zipCode;
    public $birthdate;
    public $dateHired;
    public $employeeId;
    public $editMode = false;

    protected $rules = [
        'lastName' => 'required',
        'firstName' => 'required',
        'middleName' => 'required',
        'address' => 'required',
        'departmentId' => 'required',
        'countryId' => 'required',
        'stateId' => 'required',
        'cityId' => 'required',
        'zipCode' => 'required',
        'birthdate' => 'required',
        'dateHired' => 'required',
    ];

    public function storeEmployee()
    {
        $this->validate();

        Employee::create([
            'last_name' => $this->lastName,
            'first_name' => $this->firstName,
            'middle_name' => $this->middleName,
            'address' => $this->address,
            'department_id' => $this->departmentId,
            'country_id' => $this->countryId,
            'state_id' => $this->stateId,
            'city_id' => $this->cityId,
            'zip_code' => $this->zipCode,
            'birthdate' => $this->birthdate,
            'date_hired' => $this->dateHired
        ]);

        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#employeeModal', 'actionModal' => 'hide']);
        session()->flash('employee-message', 'Employee successfully created');
    }
    
    public function showEmployee($id)
    {   
        $this->reset();
        $this->editMode = true;
        $this->employeeId = $id;

        $employee = Employee::find($this->employeeId);
        $this->lastName = $employee->last_name;
        $this->firstName = $employee->first_name;
        $this->middleName = $employee->middle_name;
        $this->address = $employee->address;
        $this->departmentId = $employee->department_id;
        $this->countryId = $employee->country_id;
        $this->stateId = $employee->state_id;
        $this->cityId = $employee->city_id;
        $this->zipCode = $employee->zip_code;
        $this->birthdate = $employee->birthdate;
        $this->dateHired = $employee->date_hired;

        $this->dispatchBrowserEvent('modal', ['modalId' => '#employeeModal', 'actionModal' => 'show']);
    }

    public function updateEmployee()
    {
       $employee = Employee::find($this->employeeId);
        $employee->update([
            'last_name' => $this->lastName,
            'first_name' => $this->firstName,
            'middle_name' => $this->middleName,
            'address' => $this->address,
            'department_id' => $this->departmentId,
            'country_id' => $this->countryId,
            'state_id' => $this->stateId,
            'city_id' => $this->cityId,
            'zip_code' => $this->zipCode,
            'birthdate' => $this->birthdate,
            'date_hired' => $this->dateHired
        ]);

        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#employeeModal', 'actionModal' => 'hide']);
        session()->flash('employee-message', 'Employee successfully updated');
    }

    public function closeModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#employeeModal', 'actionModal' => 'hide']);
    }

    public function deleteEmployee($id)
    {
        Employee::destroy($id);
    }

    public function render()
    {
        $employees = Employee::all();
        $departments = Department::all();
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        return view('livewire.employee.employee-index', [
            'employees' => $employees,
            'departments' => $departments,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities
        ])->layout('layouts.main');
    }
}
