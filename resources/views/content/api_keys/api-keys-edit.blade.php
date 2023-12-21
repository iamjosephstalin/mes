@extends('layouts/contentNavbarLayout')

@section('title', 'API Keys - Edit')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Edit/</span>API Key</h4>
<div class="row">
    <div class="card-body">
        <form action="{{ route('api-keys.update', ['api_key' => $apiKey->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <label for="status" class="col-sm-12 col-form-label">Status</label>
                <div class="col-sm-12">
                <select name="status" id="status" class="form-control">
                    <option value="1" {{ $apiKey->status == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $apiKey->status == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="api_key" class="col-sm-12 col-form-label">API Key</label>
                <div class="col-sm-12">
                    <input type="text" name="api_key" id="api_key" class="form-control" value="{{ $apiKey->api_key }}" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-12">
                    <input type="checkbox" name="products" id="products" @if($apiKey->products) checked @endif>
                    <label for="products" class="col-sm-12 col-form-label">Products</label>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-12">
                    <input type="checkbox" name="orders" id="orders" @if($apiKey->orders) checked @endif>
                    <label for="orders" class="col-sm-12 col-form-label">Orders</label>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-12">
                    <input type="checkbox" name="files" id="files" @if($apiKey->files) checked @endif>
                    <label for="files" class="col-sm-12 col-form-label">Files</label>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-12">
                    <input type="checkbox" name="clients" id="clients" @if($apiKey->clients) checked @endif>
                    <label for="clients" class="col-sm-12 col-form-label">Clients</label>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
            <input type="hidden" id="id" name="id" value="{{ $apiKey->id }}"/>
        </form>
    </div>
</div>
@endsection
