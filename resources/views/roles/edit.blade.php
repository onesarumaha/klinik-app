@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Role</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Role</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Role Permissions</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('roles.update', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Role Name</label>
                                <input type="text" class="form-control" name="name" value="{{ ucfirst($role->name) }}"
                                    readonly disabled>
                                <!-- We don't want to change role name really as it's linked to logic. Maybe just show it. -->
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered">
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
                                                    @endphp
                                                    <td class="text-center">
                                                        @if($permId)
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="perm_{{ $permId }}" name="permissions[]" value="{{ $permId }}"
                                                                    {{ $role->permissions->contains($permId) ? 'checked' : '' }}>
                                                                <label class="custom-control-label" for="perm_{{ $permId }}"></label>
                                                            </div>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        <!-- Dashboard separate or included? I didn't verify if dashboard fits the pattern. 
                                             My seeder created view_dashboard only. It won't fit the loop perfect.
                                             Let's handle extras manually or ignore for now. -->
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-group mt-3">
                                <label>Additional Permissions</label>
                                <div class="custom-control custom-checkbox">
                                    @php $dashId = $permissionsMap['view_dashboard'] ?? null; @endphp
                                    @if($dashId)
                                        <input type="checkbox" class="custom-control-input" id="perm_{{ $dashId }}"
                                            name="permissions[]" value="{{ $dashId }}" {{ $role->permissions->contains($dashId) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="perm_{{ $dashId }}">View Dashboard</label>
                                    @endif
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Permissions</button>
                            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection