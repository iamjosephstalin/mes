@extends('layouts/contentNavbarLayout')

@section('title', 'API Keys - Create')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Create/</span>API Key</h4>
<div class="row">
    <div class="card-body">
        <form action="{{ route('api-keys.store') }}" method="POST">
            @csrf
            <div class="row">
                <label for="status" class="col-sm-12 col-form-label">Status</label>
                <div class="col-sm-12">
                    <select name="status" id="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="api_key" class="col-sm-12 col-form-label">API Key</label>
                <div class="col-sm-12">
                    <input type="text" name="api_key" id="api_key" class="form-control" value="{{ $apiKey }}" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-12">
                    <input type="checkbox" name="products" id="products">
                    <label for="products" class="col-sm-12 col-form-label">Products</label>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-12">
                    <input type="checkbox" name="orders" id="orders">
                    <label for="orders" class="col-sm-12 col-form-label">Orders</label>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-12">
                    <input type="checkbox" name="files" id="files">
                    <label for="files" class="col-sm-12 col-form-label">Files</label>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-12">
                    <input type="checkbox" name="clients" id="clients">
                    <label for="clients" class="col-sm-12 col-form-label">Clients</label>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
