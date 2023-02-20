@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="w-full sm:px-6">
            <div class="flex flex-row-reverse">
                <a href="{{ route('add-cake') }}"
                   class="inline-flex items-center bg-white mb-5 hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>

                    Add Cake
                </a>
            </div>

            @if (session('status'))
                <div
                    class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4"
                    role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    Cakes
                </header>

                <div class="flex flex-col mx-3">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="min-w-full text-center">
                                    <thead class="border-b bg-gray-800">
                                    <tr>
                                        <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                            #
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                            Name
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                            Description
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                            Price
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-white py-4">
                                            Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($cakes as $cake)
                                        <tr class="bg-white border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $cake->id }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {{ $cake->name }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {{ $cake->description }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {{ $cake->price }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-0 py-3 whitespace-nowrap">
                                                <a href="{{ route('edit-cake', $cake->id) }}"
                                                   class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-blue-500 text-sm font-medium rounded-md">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="#3b82f6"
                                                         class="w-4 h-4 mr-0.5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                                                    </svg>

                                                    Edit
                                                </a> /
                                                <form action="{{ route('delete-cake', $cake->id) }}" class="inline"
                                                      method="POST">
                                                    @csrf
                                                    @method('delete')

                                                    <button
                                                        type="submit"
                                                        class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-red-500 text-sm font-medium rounded-md">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="#ef4444"
                                                             class="w-4 h-4 mr-0.5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M6 18L18 6M6 6l12 12"/>
                                                        </svg>

                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{ $cakes->links() }}
            </section>
        </div>
    </main>
@endsection
