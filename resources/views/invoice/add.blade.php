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
                            <div class="xl:w-96 w-80 sm:w-40">
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

                                @error('customer_id')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                                @enderror
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
                                    <table class="min-w-full border text-center" id="customFields">
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
                                        <tr class="border-b item">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">
                                                <select name="cake_id[]"
                                                        id="cake_id[]"
                                                        class="form-select border-none appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                        aria-label="Default select example">
                                                    <option selected>Select Item</option>
                                                    @foreach($cakes as $cake)
                                                        <option value="{{ $cake->id }}">{{ $cake->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">
                                                <input type="number"
                                                       id="quantity[]"
                                                       class="form-input border-none w-full"
                                                       name="quantity[]" value="1" dir="rtl" required>
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">
                                                <input type="number"
                                                       id="rate[]"
                                                       class="form-input border-none w-full"
                                                       name="rate[]" value="0" dir="rtl" required>
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                <input type="number"
                                                       id="amount[]"
                                                        class="form-input border-transparent focus:border-transparent focus:ring-0 border-none w-full"
                                                        readonly
                                                        name="amount[]" value="0" dir="rtl" required>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2">
                        <div class="flex align-middle items-center bg-slate-100 w-1/3 p-4 hover:cursor-pointer rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#408dfb" class="w-6 h-6 mr-2">
                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z" clip-rule="evenodd" />
                            </svg>

                            <span class="text-sm mt-0.5" id="addItem">Add new line</span>
                        </div>

                        <div class="flex rounded-lg justify-between items-center bg-slate-100 p-3">
                            <div class="text-sm">Sub Total</div>

                            <input
                                class="text-sm border-transparent focus:border-transparent focus:ring-0 bg-slate-100 border-none"
                                type="number"
                                id="total"
                                name="total"
                                dir="rtl"
                                readonly
                            />
                        </div>

                        @error('total')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <button type="submit"
                                class="select-none font-bold whitespace-no-wrap p-5 rounded-lg text-base leading-normal no-underline text-white bg-blue-500 hover:bg-blue-700 sm:py-4">
                            {{ __('Send') }}
                        </button>
                    </div>
                </form>

            </section>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        function _x(STR_XPATH) {
            const xresult = document.evaluate(STR_XPATH, document, null, XPathResult.ANY_TYPE, null);
            const xnodes = [];
            let xres;
            while (xres = xresult.iterateNext()) {
                xnodes.push(xres);
            }

            return xnodes;
        }

        function setTotalAmount() {
            let total = 0;

            $("tr.item").each(function() {
                const totalEle = $(this).find(_x('/html/.//input[@id="amount[]"]'));

                total += parseInt(totalEle.val());
            });

            document.querySelector('#total').value = total;
        }

        function setTotal(cakes) {
            $("tr.item").each(function() {
                let qty = 1, rate = 0;
                const tr = this;
                const totalEle = $(tr).find(_x('/html/.//input[@id="amount[]"]'));

                $(tr).find(_x('/html/.//input[@id="quantity[]"]')).keyup(function (e) {
                    qty = e.target.value;

                    totalEle.val(qty * rate);
                    setTotalAmount();
                });

                $(tr).find(_x('/html/.//input[@id="rate[]"]')).keyup(function (e) {
                    rate = e.target.value;

                    totalEle.val(qty * rate);
                    setTotalAmount();
                });

                $(tr).find(_x('/html/.//select[@id="cake_id[]"]')).change(function (e) {
                    if (e.target.value === 'Select Item') {
                        rate = 0;
                    } else {
                        rate = cakes[e.target.value - 1]?.price;
                    }

                    $(tr).find(_x('/html/.//input[@id="rate[]"]')).val(rate);
                    totalEle.val(qty * rate);
                    setTotalAmount();
                });
            });
        }

        $(document).ready(function () {
            const cakes = {!! json_encode($cakes) !!};

            $("#addItem").click(function () {
                let options = '';
                cakes.forEach(cake => {
                    options += '<option value="' + cake.id + '">' + cake.name + '</option>';
                });

                $("#customFields").append(
                    '<tr class="border-b item">' +
                        '<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">' +
                            ' <select name="cake_id[]" class="form-select border-none appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">' +
                                '<option selected>Select Item</option>' +
                                options +
                                '</select>' +
                        '</td>' +
                        '<td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">' +
                            '<input type="number" id="quantity[]" class="form-input border-none w-full" name="quantity[]" value="1" dir="rtl" required>' +
                        '</td>' +
                        '<td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">' +
                            '<input type="number" id="rate[]" class="form-input border-none w-full" name="rate[]" value="0" dir="rtl" required>' +
                        '</td>' +
                        '<td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">' +
                            '<input type="number" id="amount[]" class="form-input border-none w-full" disabled name="amount[]" value="0" dir="rtl" required>' +
                        '</td>' +
                    '</tr>'
                );

                setTotal(cakes);
            });

            $("#customFields").on('click', '#remCF', function () {
                $(this).parent().parent().remove();
            });

            setTotal(cakes);
            setTotalAmount();
        });
    </script>
@endsection

