@extends('layouts.app')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Roles Management</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Roles</li>
        </ol>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ session('error') }}
    </div>
    @endif

    <!-- Add New Role - Collapsible -->
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Add New Role</h6>
            <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseAddRole" aria-expanded="false" aria-controls="collapseAddRole">
                <i class="fas fa-plus"></i> Show/Hide
            </button>
        </div>
        <div class="collapse" id="collapseAddRole">
            <div class="card-body">
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Role Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter role name" required>
                    </div>
                    <!-- Assuming new roles start with no permissions, user updates them later, OR we could add matrix here too. 
                         For simplicity, let's keep create simple. -->
                    <button type="submit" class="btn btn-success">Create Role</button>
                </form>
            </div>
        </div>
    </div>

    <!-- List of Roles as Editable Cards -->
    @foreach($roles as $role)
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">{{ ucfirst($role->name) }}</h6>
             <!-- Delete Button -->
            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this role?');" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </div>
        <div class="card-body">
            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Role Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="{{ $role->name }}" required>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th>Module</th>
                                <th class="text-center">View</th>
                                <th class="text-center">Create</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($modules as $module)
                            <tr>
                                <td>{{ ucwords(str_replace('_', ' ', $module)) }}</td>
                                @foreach(['view', 'create', 'edit', 'delete'] as $action)
                                    @php
                                        $slug = $action . '_' . $module;
                                        $permId = $permissionsMap[$slug] ?? null;
                                        $uniqueId = $role->id . '_' . ($permId ?? $slug); // Unique ID for label matching
                                    @endphp
                                    <td class="text-center">
                                        @if($permId)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" 
                                                id="perm_{{ $uniqueId }}" 
                                                name="permissions[]" 
                                                value="{{ $permId }}"
                                                {{ $role->permissions->contains($permId) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="perm_{{ $uniqueId }}"></label>
                                        </div>
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="form-group mt-3">
                    <label>Additional Permissions</label>
                    <div class="custom-control custom-checkbox">
                        @php $dashId = $permissionsMap['view_dashboard'] ?? null; $uniqueDashId = $role->id . '_dash_' . $dashId; @endphp
                        @if($dashId)
                        <input type="checkbox" class="custom-control-input" id="perm_{{ $uniqueDashId }}" name="permissions[]" value="{{ $dashId }}" {{ $role->permissions->contains($dashId) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="perm_{{ $uniqueDashId }}">View Dashboard</label>
                        @endif
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update {{ ucfirst($role->name) }}</button>
            </form>
        </div>
    </div>
    @endforeach

</div>
@endsection