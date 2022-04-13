<div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Employee</h1>
    </div>
    <div class="row">
        <div class="card  mx-auto">
            <div>
                @if (session()->has('employee-message'))
                    <div class="alert alert-success">
                        {{ session('employee-message') }}
                    </div>
                @endif
            </div>
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <form method="GET" action="{{ route('employees.index') }}">
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#employeeModal">
                        Create Employee
                    </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table" wire:loading.remove>
                    <thead>
                        <tr>
                            <th scope="col">#Id</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Department</th>
                            <th scope="col">Country</th>
                            <th scope="col">Date Hired</th>
                            <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $employee)
                            <tr>
                                <th scope="row">{{ $employee->id }}</th>
                                <td>{{ $employee->first_name }}</td>
                                <td>{{ $employee->department->name }}</td>
                                <td>{{ $employee->country->name }}</td>
                                <td>{{ $employee->date_hired }}</td>
                                <td>
                                    <button wire:click="showEmployee({{ $employee->id }})" class="btn btn-success">Edit</button>
                                    <button wire:click="deleteEmployee({{ $employee->id }})" class="btn btn-danger">Delete</button>
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
  <div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="employeeModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form>

                <div class="form-group row">
                    <label for="lastName"
                        class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                    <div class="col-md-6">
                        <input id="lastName" type="text"
                            class="form-control @error('lastName') is-invalid @enderror"
                            wire:model.defer="lastName">

                        @error('lastName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="firstName"
                        class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                    <div class="col-md-6">
                        <input id="firstName" type="text"
                            class="form-control @error('firstName') is-invalid @enderror"
                            wire:model.defer="firstName">

                        @error('firstName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="middleName"
                        class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }}</label>

                    <div class="col-md-6">
                        <input id="middleName" type="text"
                            class="form-control @error('middleName') is-invalid @enderror"
                            wire:model.defer="middleName">

                        @error('middleName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address"
                        class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                    <div class="col-md-6">
                        <input id="adddress" type="text"
                            class="form-control @error('adddress') is-invalid @enderror"
                            wire:model.defer="address">

                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="departmentId"
                        class="col-md-4 col-form-label text-md-right">{{ __('Department Name') }}</label>
    
                    <div class="col-md-6">
                        <select wire:model.defer="departmentId" class="form-control" aria-label="Default select example">
                            <option selected>Choose</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                          </select>
                          {{-- <input id="countryId" type="text"
                            class="form-control @error('countryId') is-invalid @enderror" wire:model.defer="countryId"> --}}
    
                        @error('departmentId')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="countryId"
                        class="col-md-4 col-form-label text-md-right">{{ __('Country Name') }}</label>
    
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
                    <label for="stateId"
                        class="col-md-4 col-form-label text-md-right">{{ __('State Name') }}</label>
    
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
                    <label for="cityId"
                        class="col-md-4 col-form-label text-md-right">{{ __('City Name') }}</label>
    
                    <div class="col-md-6">
                        <select wire:model.defer="cityId" class="form-control" aria-label="Default select example">
                            <option selected>Choose</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                          </select>
                          {{-- <input id="countryId" type="text"
                            class="form-control @error('countryId') is-invalid @enderror" wire:model.defer="countryId"> --}}
    
                        @error('cityId')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
    
                <div class="form-group row">
                    <label for="zipCode"
                        class="col-md-4 col-form-label text-md-right">{{ __('Zip Code') }}</label>
    
                    <div class="col-md-6">
                        <input id="name" type="name" class="form-control @error('name') is-invalid @enderror"
                            wire:model.defer="zipCode">
    
                        @error('zipCode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
    
                <div class="form-group row">
                    <label for="birthdate"
                        class="col-md-4 col-form-label text-md-right">{{ __('Birthdate') }}</label>
    
                    <div class="col-md-6">
                        <input id="name" type="date" class="form-control @error('name') is-invalid @enderror"
                            wire:model.defer="birthdate">
    
                        @error('birthdate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
    
                <div class="form-group row">
                    <label for="dateHired"
                        class="col-md-4 col-form-label text-md-right">{{ __('Date Hired') }}</label>
    
                    <div class="col-md-6">
                        <input id="name" type="date" class="form-control @error('name') is-invalid @enderror"
                            wire:model.defer="dateHired">
    
                        @error('dateHired')
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
            <button type="button" class="btn btn-primary" wire:click="updateEmployee">Update Employee</button>  
          @else
            <button type="button" class="btn btn-primary" wire:click="storeEmployee">Store Employee</button>  
          @endif
        </div>
      </div>
    </div>
  </div>
        
    </div>
</div>
