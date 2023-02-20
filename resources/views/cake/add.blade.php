@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="w-full sm:px-10 mb-10">
            <div class="flex mb-5">
                <a href="{{ route('cake') }}"
                   class="bg-white inline-flex items-center hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                    </svg>

                    Back
                </a>
            </div>

            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    Add Cake
                </header>

                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8 mb-10" method="POST"
                      action="{{ route('add-cake') }}">
                    @csrf

                    <div class="flex flex-wrap">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('Name') }}:
                        </label>

                        <input id="name" type="text" class="form-input w-full @error('name')  border-red-500 @enderror"
                               name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <label for="price" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('Price') }}:
                        </label>

                        <input id="price" type="number"
                               class="form-input w-full @error('price')  border-red-500 @enderror"
                               name="price" value="{{ old('price') }}" required>

                        @error('price')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('Description') }}:
                        </label>

                        <textarea id="description"
                                  class="form-input w-full @error('description') border-red-500 @enderror"
                                  name="description">
                            {{ old('description') }}
                        </textarea>

                        @error('email')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <button type="submit"
                                class="px-6 select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:py-4">
                            {{ __('Create') }}
                        </button>
                    </div>
                </form>

            </section>
        </div>
    </main>
@endsection
