@extends('layout')

@section('content')
@include('partials._search')

<h2>
    {{ $listing['title'] }}
</h2>
<p>
    {{ $listing['description'] }}
</p>

<a href="/">Back</a>

@endsection
