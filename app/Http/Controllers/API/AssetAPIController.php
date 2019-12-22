<?php

namespace App\Http\Controllers\API;

use App\Models\Asset;
use Illuminate\Http\Request;

class AssetAPIController extends APIController
{
    private $validationRules = [
        'name' => 'required|string|max:60',
        'asset_type_id' => 'required|exists:asset_types,id|numeric|nullable',
        'product_id' => 'required|exists:products,id|numeric',
        'state_id' => 'required|exists:states,id|numeric',
        'site_id' => 'exists:sites,id|numeric|nullable',
        'user_id' => 'exists:users,id|numeric|nullable',
        'barcode' => 'string|nullable|max:120',
        'serial_no' => 'string|nullable|max:120',
        'description' => 'string|nullable|max:500',
    ];

     /**
     * List
     *
     * Get list of all assets
     * @authenticated
     * @response {}
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function index(Request $request)
    {
        $withTrashed = !!$request->input('with_trashed');

        $assets = Asset::withTrashed($withTrashed)->where('asset_type_id', $request->input('asset_type_id'))->with(['product', 'state', 'user', 'site'])->get();

        return $this->sendSuccessResponse(__('asset.fetch_success'), $assets);
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

        $asset = Asset::create($data);

        return $this->sendSuccessResponse(__('asset.store_success'), $asset);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $asset = Asset::withTrashed()->findOrFail($id);

        return $this->sendSuccessResponse(__('asset.fetch_success'), $asset);
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

        $asset = Asset::withTrashed()->findOrFail($id);


        if( 'restore' === $request->input('action')) {
            $asset->restore();
            return $this->sendSuccessResponse(__('asset.restore_success'), $asset);
        }

        $data = $request->validate($this->validationRules);

        $asset->update($data);

        //update code

        return $this->sendSuccessResponse(__('asset.update_success'), $asset);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($siteId, Request $request)
    {
        $asset = Asset::withTrashed()->find($siteId);

        if(empty($asset))
            return $this->sendErrorResponse(__('asset.destroy_not_found'), null, 404);

        if('true' === $request->input('permanently')) {
            $asset->forceDelete();
            return $this->sendSuccessResponse(__('asset.destroy_p_success'));
        }

        $asset->delete();
        return $this->sendSuccessResponse(__('asset.destroy_success'));
    }
}
