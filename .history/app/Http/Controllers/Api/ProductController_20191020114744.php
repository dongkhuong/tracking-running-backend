<?php


namespace App\Http\Controllers\Api;

use App\Http\Models\Product;
use App\Http\Requests\Api\CreateProductRequest;
use App\Http\Requests\Api\UpdateProductRequest;
use App\Http\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends MainController
{
    protected $productService;

    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }

    /**
     * Create new product
     *
     * @param CreateProductRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateProductRequest $request)
    {
        $input = $request->all();
        $images = $request->file('images');

        $input['images'] = $images;

        $product = $this->productService->create($input);

        return $this->jsonOut([
            'data' => $product,
        ]);
    }

    /**
     * Get detail product
     *
     * @param $product
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($product)
    {
        $product = $this->productService->getDetail($product);

        return $this->jsonOut([
            'data' => $product,
        ]);
    }

    /**
     * Get lít article
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $product = $this->productService->getList($request->all());
        return $this->jsonOut([
            'data' => $product->paginate(),
        ]);
    }

    /**
     *
     * @param Product $product
     * @param $request
     * @return JsonResponse
     */
    public function update(Product $product, UpdateProductRequest $request )
    {
        $input = $request->all();
        if($request->hasFile('images')) {
            $input['images'] = $request->file('images');
        }

        $product = $this->productService->update($product, $input);

        return $this->jsonOut([
            'data' => $product,
        ]);
    }

    public function like(Product $product)
    {
        $product = $this->productService->toggleLike($product->id);

        return $this->jsonOut([
            'data' => $product,
        ]);
    }
}