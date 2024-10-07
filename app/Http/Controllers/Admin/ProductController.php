<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\TaxRepositoryInterface;
use App\Repositories\Interface\CityRepositoryInterface;
use App\Repositories\Interface\ZoneRepositoryInterface;
use App\Repositories\Interface\CountryRepositoryInterface;
use App\Repositories\Interface\ProductRepositoryInterface;
use App\Repositories\Interface\CategoryRepositoryInterface;
use App\Repositories\Interface\CurrencyRepositoryInterface;
use App\Repositories\Interface\ProductSpecificationRepositoryInterface;

class ProductController extends Controller
{
    protected $categoryRepository;
    protected $productRepository;
    protected $specificationRepository;
    private $taxRepository;
    private $currencyRepository;
    private $zoneRepository;
    private $countryRepository;
    private $cityRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        ProductRepositoryInterface $productRepository,
        TaxRepositoryInterface $taxRepository,
        ProductSpecificationRepositoryInterface $specificationRepository,
        CurrencyRepositoryInterface $currencyRepository,
        ZoneRepositoryInterface $zoneRepository,
        CountryRepositoryInterface $countryRepository,
        CityRepositoryInterface $cityRepository,
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->specificationRepository = $specificationRepository;
        $this->taxRepository = $taxRepository;
        $this->currencyRepository = $currencyRepository;
        $this->zoneRepository = $zoneRepository;
        $this->countryRepository = $countryRepository;
        $this->cityRepository = $cityRepository;
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->productRepository->dataTable();
        }

        return view('backend.product.index');
    }

    public function create(Request $request)
    {
        if (isset($request->parent_id)) {
            return response()->json(['subs' => $this->categoryRepository->categoriesDropDown($request)]);
        }

        $taxes = $this->taxRepository->getAllActiveTaxes();
        $currencies = $this->currencyRepository->getAllActiveCurrencies();
        $zones = $this->zoneRepository->getAllActiveZones();
        $countries = $this->countryRepository->getAllActiveCountry();
        $cities = $this->cityRepository->getAllActiveCity();

        return view('backend.product.create', compact('taxes', 'currencies', 'zones', 'countries', 'cities'));
    }

    public function store(Request $request)
    {
        return $this->productRepository->storeProduct($request);
    }

    public function destroy($id)
    {
        $this->productRepository->deleteProduct($id);

        return response()->json([
            'status' => true,
            'load' => true,
            'message' => "Product deleted successfully"
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        return $this->productRepository->updateStatus($request, $id);
    }

    public function updateFeatured(Request $request, $id)
    {
        return $this->productRepository->updateFeatured($request, $id);
    }
    public function specification(Request $request)
    {
        if (isset($request->category_id)) {

            return response()->json(['keys' => $this->specificationRepository->keys($request->category_id)]);
        } elseif ($request->key_id) {
            return response()->json(['types' => $this->specificationRepository->types($request->key_id)]);
        } elseif ($request->type_id) {
            return response()->json(['attributes' => $this->specificationRepository->attributes($request->type_id)]);
        }
        return false;
    }

    public function edit($id)
    {
        $model = $this->productRepository->getProductById($id);

        $taxes = $this->taxRepository->getAllActiveTaxes();
        $currencies = $this->currencyRepository->getAllActiveCurrencies();
        $zones = $this->zoneRepository->getAllActiveZones();
        $countries = $this->countryRepository->getAllActiveCountry();
        $cities = $this->cityRepository->getAllActiveCity();
        return view('backend.product.edit', compact('model', 'taxes', 'currencies', 'zones', 'countries', 'cities'));
    }

    public function update(Request $request, $id)
    {
        return $this->productRepository->updateProduct($request, $id);
    }

    public function stock($id)
    {
        $models = $this->productRepository->getProductStockPurchaseDetails($id);

        return view('backend.product.stock', compact('models'));
    }
}