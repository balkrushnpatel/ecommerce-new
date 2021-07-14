@extends('admin.brand.create')
@section('editId', route('brand.update', encrypt($brand->id)))
@section('title',' Brand Edit')
@section('editMethod')
	{{method_field('PUT')}}
@endsection