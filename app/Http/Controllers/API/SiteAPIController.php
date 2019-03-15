<?php

namespace App\Http\Controllers\API;

use App\Models\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\API\APIController;

class SiteAPIController extends APIController
{

    private $validationRules = [
        'name' => 'required|string|unique:sites|max:30',
        'shortcode' => 'required|string|unique:sites|max:5',
        'latitude' => 'numeric|nullable',
        'longitude' => 'numeric|nullable',
        'phone' => 'string|nullable|max:10',
        'address1' => 'string|nullable|max:30',
        'address2' => 'string|nullable|max:30',
        'city' => 'string|nullable|max:30',
        'postcode' => 'string|nullable|max:10',
        'description' => 'string|nullable|max:500'
    ];
     /**
     * List
     *
     * Get list of all sites
     * @authenticated
     * @response {}
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    
    public function index(Request $request)
    {   
        $withTrashed = !!$request->input('with_trashed');
        
        $sites = Site::withTrashed($withTrashed)->withCount('assets')->get();
        
        return $this->sendSuccessResponse(__('sites.fetch_success'), $sites);
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

        $site = Site::create($data);

        return $this->sendSuccessResponse(__('sites.store_success'), $site);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $site = Site::withTrashed()->findOrFail($id);

        return $this->sendSuccessResponse(__('sites.store_success'), $site);
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
        $data = $request->validate($this->validationRules);

        $site = Site::create($data);

        return $this->sendSuccessResponse(__('sites.store_success'), $site);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($siteId, Request $request)
    {
        $site = Site::withTrashed()->find($siteId);

        if(empty($site))
            return $this->sendErrorResponse(__('sites.destroy_not_found'), null, 404);

        if($request->input('permanent')) {
            $site->forceDelete();
            return $this->sendSuccessResponse(__('sites.destroy_p_success'));
        }

        $site->delete();
        return $this->sendSuccessResponse(__('sites.destroy_success'));
    }
}
