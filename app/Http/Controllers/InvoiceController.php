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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $invoices = DB::table('invoices')->paginate(15);

        return view('invoice.index', [
            'invoice' => $invoices
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
            'type' => ['required', 'string'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'company_name' => ['max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'numeric', 'min:10'],
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

            Invoice::query()->create($request->except('_token'));

            return redirect()->route('cake');
        }

        $customers = Customer::query()->select(['id', 'first_name', 'last_name'])->get();
        $cakes = Cake::query()->select(['id', 'name'])->get();

        return view('invoice.add', [
            'customers' => $customers,
            'cakes' => $cakes
        ]);
    }
}
