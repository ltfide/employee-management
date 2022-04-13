<?php

namespace App\Http\Livewire\State;

use App\Models\Country;
use App\Models\State;
use Livewire\Component;

class StateIndex extends Component
{
    public $countryId;
    public $name;
    public $stateId;
    public $editMode = false;

    protected $rules = [
        'countryId' => 'required',
        'name' => 'required'
    ];

    public function storeState()
    {
        $this->validate();

        State::create([
            'country_id' => $this->countryId,
            'name' => $this->name
        ]);

        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#stateModal', 'actionModal' => 'hide']);
        session()->flash('state-message', 'State successfully created');
    }
    
    public function showState($id)
    {   
        $this->reset();
        $this->editMode = true;
        $this->stateId = $id;

        $state = State::find($this->stateId);
        $this->countryId = $state->country_id;
        $this->name = $state->name;

        $this->dispatchBrowserEvent('modal', ['modalId' => '#stateModal', 'actionModal' => 'show']);
    }

    public function updateState()
    {
        $state = State::find($this->stateId);
        $state->update([
            'country_id' => $this->countryId,
            'name' => $this->name 
        ]);

        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#stateModal', 'actionModal' => 'hide']);
        session()->flash('state-message', 'State successfully updated');
    }

    public function closeModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#stateModal', 'actionModal' => 'hide']);
    }

    public function deleteState($id)
    {
        State::destroy($id);
    }

    public function render()
    {
        $states = State::all();
        $countries = Country::all();

        return view('livewire.state.state-index', [
            'states' => $states,
            'countries' => $countries
        ])->layout('layouts.main');
    }
}
