<?php

namespace App\Http\Controllers\API;

use App\Models\State;
use Illuminate\Http\Request;

class StateAPIController extends APIController
{
    private $validationRules = [
        'name' => 'required|string|max:60',
        'description' => 'string|nullable|max:100'
    ];

    /**
     * List
     *
     * Get list of all states
     * @authenticated
     * @response {}
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
    */

    public function index(Request $request)
    {
        $withTrashed = !!$request->input('with_trashed');

        $states = State::withTrashed($withTrashed)->withCount('assets')->get();

        return $this->sendSuccessResponse(__('states.fetch_success'), $states);
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

        $state = State::create($data);

        return $this->sendSuccessResponse(__('states.store_success'), $state);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $state = State::withTrashed()->findOrFail($id);

        return $this->sendSuccessResponse(__('states.fetch_success'), $state);
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

        $state = State::withTrashed()->findOrFail($id);


        if( 'restore' === $request->input('action')) {
            $state->restore();
            return $this->sendSuccessResponse(__('states.restore_success'), $state);
        }

        $data = $request->validate($this->validationRules);

        $state->update($data);

        //update code

        return $this->sendSuccessResponse(__('states.update_success'), $state);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($stateId, Request $request)
    {
        $state = State::withTrashed()->find($stateId);

        if(empty($state))
            return $this->sendErrorResponse(__('states.destroy_not_found'), null, 404);

        if('true' === $request->input('permanently')) {
            $state->forceDelete();
            return $this->sendSuccessResponse(__('states.destroy_p_success'));
        }

        $state->delete();
        return $this->sendSuccessResponse(__('states.destroy_success'));
    }
}
