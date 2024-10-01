<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Repositories\Interface\CurrencyRepositoryInterface;

class CurrencyController extends Controller
{
    private $currencyRepository;

    public function __construct(CurrencyRepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {

            $models = $this->currencyRepository->getAllCurrencies();
            return Datatables::of($models)
                ->addIndexColumn()
                ->editColumn('country', function($model) {
                    return $model->country->name;   
                })
                ->editColumn('status', function ($model) {
                    return $model->status == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
                })
                ->addColumn('action', function ($model) {
                    return view('backend.currency.action', compact('model'));
                })
                ->rawColumns(['action', 'status', 'country'])
                ->make(true);
        }

        return view('backend.currency.index');
    }

    public function create()
    {
        $countries = Country::where('status', 1)->get();
        return view('backend.currency.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'code'          => 'required',
            'status'        => 'required',
            'symbol'        => 'required|string|max:255',
            'country_id'    => 'required|unique:currencies',
            'exchange_rate' => 'required|numeric',
        ]);

        $this->currencyRepository->createCurrency($data);

        return response()->json([
            'status' => true, 
            'load' => true,
            'message' => "Currency created successfully"
        ]);
    }

    public function edit($id)
    {
        $countries = Country::where('status', 1)->get();
        $model = $this->currencyRepository->findCurrencyById($id);
        return view('backend.currency.edit', compact('model', 'countries'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'code'          => 'required',
            'status'        => 'required',
            'symbol'        => 'required|string|max:255',
            'country_id'    => 'required|unique:currencies,country_id,' . $id,
            'exchange_rate' => 'required|numeric',
        ]);

        $this->currencyRepository->updateCurrency($id, $data);

        return response()->json([
            'status' => true, 
            'load' => true,
            'message' => "Currency updated successfully"
        ]);
    }

    public function destroy($id)
    {
        $this->currencyRepository->deleteCurrency($id);

        return response()->json([
            'status' => true, 
            'load' => true,
            'message' => "Currency deleted successfully"
        ]);
    }
}
