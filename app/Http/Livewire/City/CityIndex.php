<?php

namespace App\Http\Livewire\City;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Livewire\Component;

class CityIndex extends Component
{
    public $stateId;
    public $name;
    public $cityId;
    public $editMode = false;

    protected $rules = [
        'stateId' => 'required',
        'name' => 'required'
    ];

    public function storeCity()
    {
        $this->validate();

        City::create([
            'state_id' => $this->stateId,
            'name' => $this->name
        ]);

        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#cityModal', 'actionModal' => 'hide']);
        session()->flash('city-message', 'City successfully created');
    }
    
    public function showCity($id)
    {   
        $this->reset();
        $this->editMode = true;
        $this->cityId = $id;

        $city = City::find($this->cityId);
        $this->stateId = $city->state_id;
        $this->name = $city->name;

        $this->dispatchBrowserEvent('modal', ['modalId' => '#cityModal', 'actionModal' => 'show']);
    }

    public function updateCity()
    {
        $city = City::find($this->cityId);
        $city->update([
            'state_id' => $this->stateId,
            'name' => $this->name 
        ]);

        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#cityModal', 'actionModal' => 'hide']);
        session()->flash('city-message', 'City successfully updated');
    }

    public function closeModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#cityModal', 'actionModal' => 'hide']);
    }

    public function deleteCity($id)
    {
        City::destroy($id);
    }


    public function render()
    {
        $cities = City::all();
        $states = State::all();

        return view('livewire.city.city-index', [
            'cities' => $cities,
            'states' => $states
        ])->layout('layouts.main');
    }
}
