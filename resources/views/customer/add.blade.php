@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="w-full sm:px-10 mb-10">
            <div class="flex mb-5">
                <a href="{{ route('customer') }}"
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
                    Add Customer
                </header>

                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8 mb-10" method="POST"
                      action="{{ route('add-customer') }}">
                    @csrf

                    <div class="flex flex-wrap align-middle">
                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200  align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                type="radio"
                                name="type"
                                id="business"
                                value="business"
                                checked>
                            <label class="form-check-label inline-block text-gray-800" for="business">Business</label>
                        </div>
                        <div class="form-check form-check-inline ml-5">
                            <input
                                class="form-check-input form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                type="radio"
                                name="type"
                                id="individual"
                                value="individual">
                            <label class="form-check-label inline-block text-gray-800"
                                   for="individual">Individual</label>
                        </div>
                    </div>

                    <div class="flex flex-wrap">
                        <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('First Name') }}:
                        </label>

                        <input id="first_name" type="text"
                               class="form-input w-full @error('first_name')  border-red-500 @enderror"
                               name="first_name" value="{{ old('first_name') }}" required autocomplete="name" autofocus>

                        @error('first_name')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <label for="last_name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('Last Name') }}:
                        </label>

                        <input id="last_name" type="text"
                               class="form-input w-full @error('last_name')  border-red-500 @enderror"
                               name="last_name" value="{{ old('last_name') }}" required>

                        @error('last_name')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <label for="display_name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('Display Name') }}:
                        </label>

                        <input id="display_name" type="text"
                               class="form-input w-full @error('display_name')  border-red-500 @enderror"
                               name="display_name" value="{{ old('display_name') }}" required>

                        @error('display_name')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <label for="company_name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('Company Name') }}:
                        </label>

                        <input id="company_name" type="text"
                               class="form-input w-full @error('company_name')  border-red-500 @enderror"
                               name="company_name" value="{{ old('company_name') }}">

                        @error('company_name')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('E-Mail Address') }}:
                        </label>

                        <input id="email" type="email"
                               class="form-input w-full @error('email') border-red-500 @enderror" name="email"
                               value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <label for="phone" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('Phone') }}:
                        </label>

                        <input id="phone" type="tel" value="{{ old('phone') }}"
                               class="form-input w-full @error('phone') border-red-500 @enderror" name="phone">

                        @error('phone')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <label for="address" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('Address') }}:
                        </label>

                        <input id="address" type="text" class="form-input w-full" value="{{ old('address') }}"
                               name="address">

                        @error('address')
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
