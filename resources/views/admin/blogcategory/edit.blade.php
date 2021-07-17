@extends('admin.blogcategory.create')
@section('editId', route('blogcategory.update', encrypt($blogCat->id)))
@section('title',' blogCategory Edit')
@section('editMethod')
	{{method_field('PUT')}}
@endsection