@extends('errors::minimal')

@section('title', __('Sesión terminada'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Sesión terminada'))
