@extends('admin.user.create')
@section('editId', route('admin.userupdate', encrypt($user->id)))
@section('title',' User Edit')
@section('editMethod')
	{{method_field('PUT')}}
@endsection