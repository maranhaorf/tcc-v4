@extends('layout.layout')

@section("content")
<x-app-layout>



        <div class="max-w-2xl  py-10 sm:px-6 lg:px-8">

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-jet-section-border />





        </div>

</x-app-layout>

@endsection
