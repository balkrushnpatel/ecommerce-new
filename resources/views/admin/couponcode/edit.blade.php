@extends('admin.couponcode.create')
@section('editId', route('couponcode.update', encrypt($code->id)))
@section('title',' couponcode Edit')
@section('editMethod')
	{{method_field('PUT')}}
@endsection