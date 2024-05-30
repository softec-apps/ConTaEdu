@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))
@section('description', __('Ha ocurrido algo inesperado, estamos trabajando para resolverlo'))
