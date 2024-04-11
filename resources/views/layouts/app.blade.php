@extends('pages.layouts.app')
@section('title', 'Trang Chủ')
@section('content')
    <main>
        {{ $slot }}
    </main>
    @stack('modals')
    @livewireScripts
@endsection
