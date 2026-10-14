@extends('layouts.turismo')

@section('content')
<div class="max-w-2xl mx-auto px-6 py-12">
    <h1 class="text-3xl font-black mb-8">EDIT PRODUK</h1>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.products._form')
    </form>
</div>
@endsection