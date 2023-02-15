<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use App\Services\ZohoIntegration;
use Asciisd\Zoho\Facades\ZohoManager;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\api\authenticator\OAuthToken;
use com\zoho\api\logger\Levels;
use com\zoho\api\logger\LogBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\exception\SDKException;
use com\zoho\crm\api\UserSignature;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use mysql_xdevapi\Exception;
use zcrmsdk\crm\exception\ZCRMException;

class CakeController extends Controller
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
        $cakes = DB::table('cakes')->paginate(15);

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
     * @throws GuzzleException
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

            $cake = Cake::create($request->except('_token'));

            $zohoCake = $this->zohoIntegration->createCake($cake);

            $cake->zoho_id = $zohoCake->item->item_id;
            $cake->save();

            return redirect()->route('cake');
        }

        return view('cake.add');
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View|RedirectResponse
     * @throws GuzzleException
     */
    public function editCake(Request $request, $id): View|Factory|RedirectResponse|Application
    {
        if ($request->isMethod('put')) {
            $validator = $this->validator($request->all());

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $cake = Cake::find($id);
            $cake->update($request->except('_token'));

            $this->zohoIntegration->updateCake($cake);

            return redirect()->route('cake');
        }

        $cake = Cake::query()->findOrFail($id);

        return view('cake.edit', ['cake' => $cake]);
    }
}
