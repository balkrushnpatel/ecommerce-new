@extends('admin.subcategory.create')
@section('editId', route('subcategory.update', encrypt($subcategory->id)))
@section('title',' SubCategory Edit')
@section('editMethod')
	{{method_field('PUT')}}
@endsection