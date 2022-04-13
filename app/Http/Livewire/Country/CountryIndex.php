<?php

namespace App\Http\Livewire\Country;

use App\Models\Country;
use Livewire\Component;

class CountryIndex extends Component
{
    public $countryCode;
    public $name;
    public $countryID;
    public $editMode = false;

    protected $rules = [
        'countryCode' => 'required',
        'name' => 'required'
    ];

    public function storeCountry()
    {
        $this->validate();

        Country::create([
            'country_code' => $this->countryCode,
            'name' => $this->name
        ]);

        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#countryModal', 'actionModal' => 'hide']);
        session()->flash('country-message', 'Country successfully created');
    }
    
    public function showCountry($id)
    {   
        $this->reset();
        $this->editMode = true;
        $this->countryID = $id;

        $country = Country::find($this->countryID);
        $this->countryCode = $country->country_code;
        $this->name = $country->name;

        $this->dispatchBrowserEvent('modal', ['modalId' => '#countryModal', 'actionModal' => 'show']);
    }

    public function updateCountry()
    {
       $country = Country::find($this->countryID);
        $country->update([
            'country_code' => $this->countryCode,
            'name' => $this->name 
        ]);

        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#countryModal', 'actionModal' => 'hide']);
        session()->flash('country-message', 'Country successfully updated');
    }

    public function closeModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#countryModal', 'actionModal' => 'hide']);
    }

    public function deleteCountry($id)
    {
        Country::destroy($id);
    }

    public function render()
    {
        $countries = Country::all();

        return view('livewire.country.country-index', [
            'countries' => $countries
        ])->layout('layouts.main');
    }
}
