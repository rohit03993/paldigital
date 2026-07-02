@extends('layouts.app')

@section('content')
    @include('partials.home.hero')
    @include('partials.home.message')
    @include('partials.home.services', ['services' => $services])
    @include('partials.home.industries', ['industries' => $industries])
    @include('partials.home.flagship', ['flagship' => $flagship])
    @include('partials.home.demo-cta')
    @include('partials.home.process')
    @include('partials.home.clients', ['clients' => $clients])
    @include('partials.home.cta')
@endsection
