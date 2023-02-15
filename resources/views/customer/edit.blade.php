@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="w-full sm:px-10 mb-10">
            <div class="flex mb-5">
                <a href="{{ route('customer') }}"
                   class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                    Back
                </a>
            </div>

            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    Edit Customer
                </header>

                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8 mb-10" method="POST"
                      action="{{ route('edit-customer', $customer->id) }}">
                    @csrf

                    <div class="flex flex-wrap align-middle">
                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200  align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                type="radio"
                                name="type"
                                id="business"
                                value="business"
                                {!! $customer->type === 'business' ? 'checked' : '' !!}
                            >
                            <label class="form-check-label inline-block text-gray-800" for="business">Business</label>
                        </div>
                        <div class="form-check form-check-inline ml-5">
                            <input
                                class="form-check-input form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                type="radio"
                                name="type"
                                id="individual"
                                value="individual"
                                {!! $customer->type === 'individual' ? 'checked' : '' !!}
                            >
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
                               name="first_name" value="{{ $customer->first_name }}" required autocomplete="name" autofocus>

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
                               name="last_name" value="{{ $customer->last_name }}" required>

                        @error('last_name')
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
                               name="company_name" value="{{ $customer->company_name }}">

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
                               value="{{ $customer->email }}" required autocomplete="email">

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

                        <input id="phone" type="tel" value="{{ $customer->phone }}"
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

                        <input id="address" type="text" class="form-input w-full" value="{{ $customer->address }}"
                               name="address">

                        @error('address')
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
