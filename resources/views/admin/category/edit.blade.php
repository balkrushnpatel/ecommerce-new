@extends('admin.category.create')
@section('editId', route('categires.update', encrypt($category->id)))
@section('title',' Category Edit')
@section('editMethod')
	{{method_field('PUT')}}
@endsection