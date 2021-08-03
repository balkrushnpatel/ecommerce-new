@extends('admin.banner.create')
@section('editId', route('banner.update', encrypt($banner->id)))
@section('title',' Banner Edit')
@section('editMethod')
	{{method_field('PUT')}}
@endsection