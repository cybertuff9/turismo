@extends('layouts.turismo')

@section('content')
<div class="max-w-2xl mx-auto px-6 py-12">
    <h1 class="text-3xl font-black mb-8">TAMBAH PRODUK</h1>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @include('admin.products._form')
    </form>
</div>
@endsection