<?php

namespace App\Http\Controllers\API;

use App\Models\CustomField;
use Illuminate\Http\Request;

class CustomFieldAPIController extends APIController
{
    private $validationRules = [
        'asset_type_id' => 'required|exists:asset_types,id|numeric|nullable',
        'name' => 'required|string|max:60',
        'order' => 'number|nullable',
        'shortcode' => 'required|alpha_dash|max:60'
        'type' => 'required|string|max:60',
        'default_value' => 'string|nullable|max:500',
        'description' => 'string|nullable|max:500',
        'options' => 'string|nullable'
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

        $customField = CustomField::withTrashed($withTrashed)->where('asset_type_id', $assetTypeId)->get();

        return $this->sendSuccessResponse(__('custom_fields.fetch_success'), $customField);
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

        $customField = CustomField::create($data);

        return $this->sendSuccessResponse(__('custom_fields.store_success'), $customField);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customField = CustomField::withTrashed()->findOrFail($id);

        return $this->sendSuccessResponse(__('custom_fields.fetch_success'), $customField);
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

        $customField = CustomField::withTrashed()->findOrFail($id);


        if( 'restore' === $request->input('action')) {
            $customField->restore();
            return $this->sendSuccessResponse(__('custom_fields.restore_success'), $customField);
        }

        $data = $request->validate($this->validationRules);

        $customField->update($data);

        //update code

        return $this->sendSuccessResponse(__('custom_fields.update_success'), $customField);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($customFieldId, Request $request)
    {
        $customField = CustomField::withTrashed()->find($customFieldId);

        if(empty($customField))
            return $this->sendErrorResponse(__('custom_fields.destroy_not_found'), null, 404);

        if('true' === $request->input('permanently')) {
            $customField->forceDelete();
            return $this->sendSuccessResponse(__('custom_fields.destroy_p_success'));
        }

        $customField->delete();
        return $this->sendSuccessResponse(__('custom_fields.destroy_success'));
    }
}
