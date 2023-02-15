<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Services\ZohoIntegration;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * @var ZohoIntegration
     */
    private ZohoIntegration $zohoIntegration;

    /**
     * @param ZohoIntegration $zohoIntegration
     */
    public function __construct(ZohoIntegration $zohoIntegration)
    {
        $this->zohoIntegration = $zohoIntegration;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $customers = DB::table('customers')->paginate(15);

        return view('customer.index', [
            'customers' => $customers
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
     * @throws GuzzleException
     */
    public function addCustomer(Request $request): View|Factory|RedirectResponse|Application
    {
        if ($request->isMethod('post')) {
            $validator = $this->validator($request->all());

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $customer = Customer::create($request->except('_token'));

            $zohoCustomer = $this->zohoIntegration->createCustomer($customer);

            $customer->zoho_id = $zohoCustomer->customer->customer_id;
            $customer->save();

            return redirect()->route('customer');
        }

        return view('customer.add');
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View|RedirectResponse
     * @throws GuzzleException
     */
    public function editCustomer(Request $request, $id): View|Factory|RedirectResponse|Application
    {
        if ($request->isMethod('put')) {
            $validator = $this->validator($request->all());

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $customer = Customer::find($id);
            $customer->update($request->except('_token'));

            $this->zohoIntegration->updateCustomer($customer);

            return redirect()->route('customer');
        }

        $customer = Customer::query()->findOrFail($id);

        return view('customer.edit', ['customer' => $customer]);
    }
}
