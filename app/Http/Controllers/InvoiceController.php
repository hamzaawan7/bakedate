<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $invoices = Invoice::query()->paginate(15);

        return view('invoice.index', [
            'invoices' => $invoices
        ]);
    }

    /**
     * Get a validator for an incoming request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'customer_id' => ['required', 'not_in:---', 'numeric'],
            'total' => ['required', 'not_in:0', 'numeric'],
            'invoice_date' => ['required', 'string', 'after:today']
        ]);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function addInvoice(Request $request): View|Factory|RedirectResponse|Application
    {
        if ($request->isMethod('post')) {
            $validator = $this->validator($request->all());

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            foreach ($request->get('cake_id') as $k => $item) {
                Invoice::query()->create([
                    'customer_id' => (int)$request->get('customer_id'),
                    'amount' => (int)$request->get('amount')[$k],
                    'invoice_date' => $request->get('invoice_date'),
                    'quantity' => (int)$request->get('quantity')[$k],
                    'cake_id' => (int)$request->get('cake_id')[$k]
                ]);
            }

            return redirect()->route('invoice');
        }

        $customers = Customer::query()->select(['id', 'first_name', 'last_name'])->get();
        $cakes = Cake::query()->select(['id', 'name', 'price'])->get();

        return view('invoice.add', [
            'customers' => $customers,
            'cakes' => $cakes
        ]);
    }
}
