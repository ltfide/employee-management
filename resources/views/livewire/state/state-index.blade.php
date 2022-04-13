<div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">State</h1>
    </div>
    <div class="row">
        <div class="card  mx-auto">
            <div>
                @if (session()->has('state-message'))
                    <div class="alert alert-success">
                        {{ session('state-message') }}
                    </div>
                @endif
            </div>
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <form method="GET" action="{{ route('states.index') }}">
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#stateModal">
                        Create State
                    </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table" wire:loading.remove>
                    <thead>
                        <tr>
                            <th scope="col">#Id</th>
                            <th scope="col">Country Name</th>
                            <th scope="col">State</th>
                            <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($states as $state)
                            <tr>
                                <th scope="row">{{ $state->id }}</th>
                                <td>{{ $state->country->name }}</td>
                                <td>{{ $state->name }}</td>
                                <td>
                                    <button wire:click="showState({{ $state->id }})" class="btn btn-success">Edit</button>
                                    <button wire:click="deleteState({{ $state->id }})" class="btn btn-danger">Delete</button>
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
  <div class="modal fade" id="stateModal" tabindex="-1" aria-labelledby="stateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="stateModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-group row">
                    <label for="countryId"
                        class="col-md-4 col-form-label text-md-right">{{ __('Country id') }}</label>
    
                    <div class="col-md-6">
                        <select wire:model.defer="countryId" class="form-control" aria-label="Default select example">
                            <option selected>Choose</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                          </select>
                          {{-- <input id="countryId" type="text"
                            class="form-control @error('countryId') is-invalid @enderror" wire:model.defer="countryId"> --}}
    
                        @error('countryId')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
    
                <div class="form-group row">
                    <label for="name"
                        class="col-md-4 col-form-label text-md-right">{{ __('State Name') }}</label>
    
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
            <button type="button" class="btn btn-primary" wire:click="updateState">Update State</button>  
          @else
            <button type="button" class="btn btn-primary" wire:click="storeState">Store State</button>  
          @endif
        </div>
      </div>
    </div>
  </div>
        
    </div>
</div>
