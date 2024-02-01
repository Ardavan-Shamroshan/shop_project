@extends('customer.layouts.master-single-col')
@section('head-tag')
    <title>{{ $page->title ?? '-' }}</title>
@endsection
@section('content')

    <?= html_entity_decode($page->body) ?>


@endsection


