@extends('admin.blog.create')
@section('editId', route('blog.update', encrypt($blog->id)))
@section('title',' Blog Edit')
@section('editMethod')
	{{method_field('PUT')}}
@endsection