<?php

namespace App\Http\Controllers\API;

use App\Models\AssetType;
use App\Models\State;
use Illuminate\Http\Request;

class AssetTypeAPIController extends APIController
{
    private $validationRules = [
        'name' => 'required|string|max:30',
        'icon' => 'required|string|max:60',
        'description' => 'string|nullable|max:500'
    ];
     /**
     * List
     *
     * Get list of all assetTypes
     * @authenticated
     * @response {}
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function index(Request $request)
    {
        $withTrashed = !!$request->input('with_trashed');

        $assetTypes = AssetType::select('id', 'name', 'icon', 'deleted_at')
                        ->withTrashed($withTrashed)
                        ->withCount('assets')
                        ->get();

        return $this->sendSuccessResponse(__('asset_types.fetch_success'), $assetTypes);
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

        $assetType = AssetType::create($data);

        $assetType->states()->create([ 'name' => 'In Storage' ]);
        $assetType->states()->create([ 'name' => 'In Use' ]);
        $assetType->states()->create([ 'name' => 'In Repair' ]);
        $assetType->states()->create([ 'name' => 'Disposed' ]);

        return $this->sendSuccessResponse(__('asset_types.store_success'), $assetType);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $assetType = AssetType::withTrashed();

        if (request()->input('with')) {
            $relatedModels = explode(',', request()->input('with'));
            $availableModels = ['products', 'customFields', 'states'];
            if (count(array_intersect($relatedModels, $availableModels)) != count($relatedModels)) {
                return $this->sendErrorResponse(__('general.model_not_exists'));
            }
            $assetType->with($relatedModels);
        }

        $assetType = $assetType->findOrFail($id);

        return $this->sendSuccessResponse(__('asset_types.fetch_success'), $assetType);
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

        $assetType = AssetType::withTrashed()->findOrFail($id);


        if( 'restore' === $request->input('action')) {
            $assetType->restore();
            return $this->sendSuccessResponse(__('asset_types.restore_success'), $assetType);
        }

        $data = $request->validate($this->validationRules);

        //update code
        $assetType->update($data);

        return $this->sendSuccessResponse(__('asset_types.update_success'), $assetType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($siteId, Request $request)
    {
        $assetType = AssetType::withTrashed()->find($siteId);

        if(empty($assetType))
            return $this->sendErrorResponse(__('asset_types.destroy_not_found'), null, 404);

        if('true' === $request->input('permanently')) {
            $assetType->forceDelete();
            return $this->sendSuccessResponse(__('asset_types.destroy_p_success'));
        }

        $assetType->delete();
        return $this->sendSuccessResponse(__('asset_types.destroy_success'));
    }
}
