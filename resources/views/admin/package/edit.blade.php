@extends('admin.package.create')
@section('editId', route('package.update', encrypt($package->id)))
@section('title',' Package Edit')
@section('editMethod')
	{{method_field('PUT')}}
@endsection