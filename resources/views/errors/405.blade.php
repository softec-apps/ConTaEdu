@extends('errors::minimal')

@section('title', __('Método no soportado'))
@section('code', '405')
@section('message', __('Método no soportado'))
@section('description', __('El método no es soportado por el recurso solicitado'))
