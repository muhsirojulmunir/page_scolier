@extends('layouts.app')

@section('content')
    @include('partials.hero')
    @include('partials.marquee')
    @include('partials.about')
    @include('partials.programs')
    @include('partials.process')
    @include('partials.journey')
    @include('partials.testimonials')
    @include('partials.faq')
    @include('partials.contact')
    @include('partials.cta')
@endsection

@push('head')
    <script type="application/ld+json">{!! \App\Support\StructuredData::organization(\App\Support\Locales::url(\App\Support\Locales::current())) !!}</script>
@endpush
