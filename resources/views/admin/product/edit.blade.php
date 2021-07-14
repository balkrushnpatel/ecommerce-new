@extends('admin.product.create')
@section('editId', route('product.update', encrypt($product->id)))
@section('title',' Product Edit')
@section('editMethod')
	{{method_field('PUT')}}
@endsection