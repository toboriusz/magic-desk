<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductAPIController extends APIController
{
    private $validationRules = [
        'asset_type_id' => 'required|exists:asset_types,id|numeric|nullable',
        'brand' => 'required|string|max:60',
        'model' => 'required|string|max:60',
        'part_no' => 'alpha_dash|nullable|max:60',
        'description' => 'string|nullable|max:500'
    ];

     /**
     * List
     *
     * Get list of all products
     * @authenticated
     * @response {}
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function index(Request $request)
    {
        $withTrashed = !!$request->input('with_trashed');
        $assetTypeId = $request->input('asset_type_id');

        $products = Product::withTrashed($withTrashed)->where('asset_type_id', $assetTypeId)->withCount('assets')->get();

        $limitStr = 30;
        foreach ($products as $key => $product) {
            if(strlen($product->description) > $limitStr - 3)
                $products[$key]->description = substr($product->description, 0, $limitStr).'...';
        }

        return $this->sendSuccessResponse(__('products.fetch_success'), $products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->validationRules);

        $product = Product::create($data);

        return $this->sendSuccessResponse(__('products.store_success'), $product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        return $this->sendSuccessResponse(__('products.fetch_success'), $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $product = Product::withTrashed()->findOrFail($id);


        if( 'restore' === $request->input('action')) {
            $product->restore();
            return $this->sendSuccessResponse(__('products.restore_success'), $product);
        }

        $data = $request->validate($this->validationRules);

        $product->update($data);

        //update code

        return $this->sendSuccessResponse(__('products.update_success'), $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($productId, Request $request)
    {
        $product = Product::withTrashed()->find($productId);

        if(empty($product))
            return $this->sendErrorResponse(__('products.destroy_not_found'), null, 404);

        if('true' === $request->input('permanently')) {
            $product->forceDelete();
            return $this->sendSuccessResponse(__('products.destroy_p_success'));
        }

        $product->delete();
        return $this->sendSuccessResponse(__('products.destroy_success'));
    }
}
