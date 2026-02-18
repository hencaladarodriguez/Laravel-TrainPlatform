@extends('layouts.app')

@section('content')

<p>Bienvenido {{ auth()->user()->nombre }}</p>

@endsection
