@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="w-full sm:px-10 mb-10">
            <div class="flex mb-5">
                <a href="{{ route('invoice') }}"
                   class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                    Back
                </a>
            </div>

            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    Add Invoice
                </header>

                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8 mb-10" method="POST"
                      action="{{ route('add-invoice') }}">
                    @csrf

                    <div class="flex items-center justify-between">
                        <div class="flex flex-wrap">
                            <div class="xl:w-96">
                                <label for="customer_id" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('Customer') }}:
                                </label>
                                <select name="customer_id"
                                        class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        aria-label="Default select example">
                                    <option selected>---</option>
                                    @foreach($customers as $customer)
                                        <option
                                            value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex flex-wrap xl:w-96">
                            <label for="invoice_date" class="block text-gray-700 text-sm font-bold sm:mb-4">
                                {{ __('Invoice Date') }}:
                            </label>

                            <input id="invoice_date" type="date"
                                   class="form-input w-full rounded border-gray-300 @error('invoice_date')  border-red-500 @enderror"
                                   name="invoice_date" value="{{ old('invoice_date') }}" required>

                            @error('invoice_date')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class="min-w-full border text-center">
                                        <thead class="border-b">
                                        <tr>
                                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 border-r">
                                                Cake
                                            </th>
                                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 border-r">
                                                Quantity
                                            </th>
                                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 border-r">
                                                Rate
                                            </th>
                                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                                                Amount
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">
                                                <select name="cake_id"
                                                        class="form-select border-none appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                        aria-label="Default select example">
                                                    <option selected>Select Item</option>
                                                    @foreach($cakes as $cake)
                                                        <option value="{{ $cake->id }}">{{ $cake->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">
                                                <input id="quantity" type="number"
                                                       class="form-input border-none w-full"
                                                       name="quantity" value="1" dir="rtl" required>
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">
                                                <input id="quantity" type="number"
                                                       class="form-input border-none w-full"
                                                       name="quantity" value="0" dir="rtl" required>
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                <input id="quantity" type="number"
                                                        class="form-input border-none w-full"
                                                        name="quantity" value="0" dir="rtl" required>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2">
                        <div class="flex align-middle bg-slate-100 w-1/3 p-4 hover:cursor-pointer rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#408dfb" class="w-6 h-6 mr-2">
                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z" clip-rule="evenodd" />
                            </svg>

                            <span class="text-sm mt-0.5">Add new line</span>
                        </div>

                        <div class="flex rounded-lg justify-between bg-slate-100 p-5">
                            <div class="text-sm">Sub Total</div>
                            <div class="text-sm">4000</div>
                        </div>
                    </div>

                    <div class="flex flex-wrap">
                        <button type="submit"
                                class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:py-4">
                            {{ __('Send') }}
                        </button>
                    </div>
                </form>

            </section>
        </div>
    </main>
@endsection
