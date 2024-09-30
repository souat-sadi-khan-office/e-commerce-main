@extends('backend.layouts.app')
@section('title', 'Update Staff Information')
@section('page_name')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="h3 mb-0">Create new Staff</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-house-add-fill"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.stuff.index') }}">Staff Management</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Update Staff Information</li>
                    </ol>
                </div>

                @if (Auth::guard('admin')->user()->hasPermissionTo('stuff.view'))
                    <div class="col-sm-6 text-end">
                        <a href="{{ route('admin.stuff.index') }}" class="btn btn-soft-danger">
                            <i class="bi bi-backspace"></i>
                            Back
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-7 mx-auto">
            <form action="{{ route('admin.stuff.update', $model->id) }}" id="content_form" method="post">
                @csrf
                @method('PATCH')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3 form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" required value="{{ $model->name }}">
                            </div>
                    
                            <div class="col-md-12 mb-3 form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" required value="{{ $model->email }}">
                            </div>
                    
                            <div class="col-md-12 mb-3 form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control" required value="{{ $model->phone}}">
                            </div>
                    
                            <div class="col-md-12 mb-3 form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                    
                            <div class="col-md-12 mb-3 form-group">
                                <label for="avatar">Avatar</label>
                                <input type="file" name="avatar" class="form-control">
                            </div>
                    
                            <div class="col-md-12 mb-3 form-group">
                                <label for="roles">Roles</label>
                                <select name="roles" class="form-control" required>
                                    @foreach ($roles as $role)
                                        <option {{ $role->name == $model->getRoleNames()->toArray()[0] ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12 form-group">
                                @if (Auth::guard('admin')->user()->hasPermissionTo('stuff.update'))
                                    <button type="submit" class="btn btn-soft-success"  id="submit">
                                        <i class="bi bi-send"></i>
                                        Update 
                                    </button>
                                @endif
                                @if (Auth::guard('admin')->user()->hasPermissionTo('stuff.view'))
                                    <a href="{{ route('admin.stuff.index') }}" class="btn btn-soft-danger">
                                        <i class="bi bi-backspace"></i>
                                        Back
                                    </a>
                                @endif
                            </div>
                    
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection