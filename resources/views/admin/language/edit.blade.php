@extends('admin.language.create')
@section('editId', route('language.update', encrypt($language->id)))
@section('title',' Language Edit')
@section('editMethod')
	{{method_field('PUT')}}
@endsection