@extends('errors::minimal')

@section('title', __('Demasiadas peticiones'))
@section('code', '429')
@section('message', __('Demasiadas peticiones'))
@section('description', __('La página ha recibido demasiadas peticiones y dejo de funcionar por seguridad'))
