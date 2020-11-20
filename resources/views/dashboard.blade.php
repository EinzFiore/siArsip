@extends('layouts/app2')
@section('title', 'Dashboard | SiArsip')
@section('judul', 'Dashboard')
@section('content')
<section class="section">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Dashboard</h4>
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-md-6">
                    <img src="{{url('img/hello.svg')}}" width="100%">
                  </div>
                  <div class="col-md-6">
                      <h3>SiArsip</h3>
                      <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Suscipit, laborum saepe! Eaque quis eius soluta quae adipisci non tempora consectetur.</p>
                      <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptate numquam modi aspernatur, amet pariatur vero.</p>
                  </div>
              </div>
          </div>
        </div>
      </div>
@endsection

{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div>
</x-app-layout> --}}
