@extends('layouts.admin.admin')

@section('title', 'Funcionários')
@section('subtitle', 'Faça a gestão dos seus funcionários aqui')

@section('content')
    @livewire('employees')
@stop
