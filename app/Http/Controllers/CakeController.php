<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use Asciisd\Zoho\Facades\ZohoManager;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CakeController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $cakes = DB::table('cakes')->paginate(15);

        $books = ZohoManager::useModule('Leads');
        dd($books->getModule());

        return view('cake.index', [
            'cakes' => $cakes
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
            'name' => ['required', 'string', 'max:255'],
            'company_name' => ['max:255'],
            'price' => ['required', 'numeric'],
        ]);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function addCake(Request $request): View|Factory|RedirectResponse|Application
    {
        if ($request->isMethod('post')) {
            $validator = $this->validator($request->all());

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            Cake::query()->create($request->except('_token'));

            return redirect()->route('cake');
        }

        return view('cake.add');
    }
}
