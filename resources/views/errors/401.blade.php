@extends('errors::minimal')

@section('title', __('No autorizado'))
@section('code', '401')
@section('message', __('No autorizado'))
@section('description', __('No esta autorizado para acceder a este recurso'))
