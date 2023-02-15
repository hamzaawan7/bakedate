@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="w-full sm:px-10 mb-10">
            <div class="flex mb-5">
                <a href="{{ route('cake') }}"
                   class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                    Back
                </a>
            </div>

            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    Edit Cake
                </header>

                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8 mb-10" method="POST"
                      action="{{ route('edit-cake', $cake->id) }}">
                    @csrf
                    @method('put')

                    <div class="flex flex-wrap">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('Name') }}:
                        </label>

                        <input id="name" type="text" class="form-input w-full @error('name')  border-red-500 @enderror"
                               name="name" value="{{ $cake->name }}" required autocomplete="name" autofocus>

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
                               name="price" value="{{ $cake->price }}" required>

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
                            {{ $cake->description }}
                        </textarea>

                        @error('email')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <button type="submit"
                                class="select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:py-4">
                            {{ __('Submit') }}
                        </button>
                    </div>
                </form>

            </section>
        </div>
    </main>
@endsection
