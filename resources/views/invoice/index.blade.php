@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="w-full sm:px-6">
            <div class="flex flex-row-reverse">
                <a href="{{ route('add-invoice') }}" class="bg-white mb-5 hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                    Add Invoice
                </a>
            </div>

            @if (session('status'))
                <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    Invoices
                </header>

                <div class="flex flex-col mx-3">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="min-w-full text-center">
                                    <thead class="border-b bg-gray-800">
                                    <tr>
                                        <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                            Customer
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                            Cake
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                            Normal
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                            Invoice Date
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                            Amount
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                            Quantity
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($invoices as $invoice)
                                        <tr class="bg-white border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $invoice->customer->first_name }} {{ $invoice->customer->last_name }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {{ $invoice->cake->name }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {{ $invoice->is_early ? 'Yes' : 'No' }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {{ $invoice->invoice_date }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {{ $invoice->amount }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {{ $invoice->quantity }}
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{ $invoices->links() }}
            </section>
        </div>
    </main>
@endsection
