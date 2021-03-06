<div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Department</h1>
    </div>
    <div class="row">
        <div class="card  mx-auto">
            <div>
                @if (session()->has('department-message'))
                    <div class="alert alert-success">
                        {{ session('department-message') }}
                    </div>
                @endif
            </div>
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <form method="GET" action="{{ route('departments.index') }}">
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#departmentModal">
                        Create Country
                    </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table" wire:loading.remove>
                    <thead>
                        <tr>
                            <th scope="col">#Id</th>
                            <th scope="col">Department Name</th>
                            <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($departments as $department)
                            <tr>
                                <th scope="row">{{ $department->id }}</th>
                                <td>{{ $department->name }}</td>
                                <td>
                                    <button wire:click="showDepartment({{ $department->id }})" class="btn btn-success">Edit</button>
                                    <button wire:click="deleteDepartment({{ $department->id }})" class="btn btn-danger">Delete</button>
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
  <div class="modal fade" id="departmentModal" tabindex="-1" aria-labelledby="departmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="departmentModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form>    
                <div class="form-group row">
                    <label for="name"
                        class="col-md-4 col-form-label text-md-right">{{ __('Country Name') }}</label>
    
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
            <button type="button" class="btn btn-primary" wire:click="updateDepartment">Update Department</button>  
          @else
            <button type="button" class="btn btn-primary" wire:click="storeDepartment">Store Department</button>  
          @endif
        </div>
      </div>
    </div>
  </div>
        
    </div>
</div>
