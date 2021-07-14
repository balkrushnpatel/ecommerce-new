@extends('admin.slider.create')
@section('editId', route('slider.update', encrypt($slider->id)))
@section('title',' Slider Edit')
@section('editMethod')
	{{method_field('PUT')}}
@endsection