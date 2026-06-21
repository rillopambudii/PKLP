{{--
    Layout perantara admin.
    Meneruskan semua section ke adminlte::page, dan menyisipkan script
    anti-flash dark mode di dalam <head> (hook adminlte_css_pre) sehingga
    tema diterapkan SEBELUM CSS dipaint — nol flash, tanpa override vendor.

    Halaman admin cukup: @extends('layouts.admin')
--}}
@extends('adminlte::page')

@section('adminlte_css_pre')
    <script>try{if(localStorage.getItem('pklp-theme')==='dark')document.documentElement.setAttribute('data-theme','dark');}catch(e){}</script>
@stop
