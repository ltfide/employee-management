<div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">City</h1>
    </div>
    <div class="row">
        <div class="card  mx-auto">
            <div>
                @if (session()->has('city-message'))
                    <div class="alert alert-success">
                        {{ session('city-message') }}
                    </div>
                @endif
            </div>
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <form method="GET" action="{{ route('cities.index') }}">
                            <div class="form-row align-items-center">
                                <div class="col">
                                    <input type="search" wire:model="search" class="form-control mb-2" id="inlineFormInput"
                                        placeholder="Search by name">
                                </div>
                                <div class="col" wire:loading>
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div>
                        <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cityModal">
                        Create City
                    </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table" wire:loading.remove>
                    <thead>
                        <tr>
                            <th scope="col">#Id</th>
                            <th scope="col">State Name</th>
                            <th scope="col">Name</th>
                            <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cities as $city)
                            <tr>
                                <th scope="row">{{ $city->id }}</th>
                                <td>{{ $city->state->name }}</td>
                                <td>{{ $city->name }}</td>
                                <td>
                                    <button wire:click="showCity({{ $city->id }})" class="btn btn-success">Edit</button>
                                    <button wire:click="deleteCity({{ $city->id }})" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        @empty 
                            <tr>
                                <td>No Result</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- <div>{{ $countries->links('pagination::bootstrap-4') }}</div> --}}
        </div>
        
  
  <!-- Modal -->
  <div class="modal fade" id="cityModal" tabindex="-1" aria-labelledby="cityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cityModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-group row">
                    <label for="stateId"
                        class="col-md-4 col-form-label text-md-right">{{ __('State id') }}</label>
    
                    <div class="col-md-6">
                        <select wire:model.defer="stateId" class="form-control" aria-label="Default select example">
                            <option selected>Choose</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                          </select>
                          {{-- <input id="countryId" type="text"
                            class="form-control @error('countryId') is-invalid @enderror" wire:model.defer="countryId"> --}}
    
                        @error('stateId')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
    
                <div class="form-group row">
                    <label for="name"
                        class="col-md-4 col-form-label text-md-right">{{ __('City Name') }}</label>
    
                    <div class="col-md-6">
                        <input id="name" type="name" class="form-control @error('name') is-invalid @enderror"
                            wire:model.defer="name">
    
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="closeModal">Close</button>
          @if ($editMode)
            <button type="button" class="btn btn-primary" wire:click="updateCity">Update City</button>  
          @else
            <button type="button" class="btn btn-primary" wire:click="storeCity">Store City</button>  
          @endif
        </div>
      </div>
    </div>
  </div>
        
    </div>
</div>
