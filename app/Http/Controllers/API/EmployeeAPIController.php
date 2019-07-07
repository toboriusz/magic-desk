<?php

namespace App\Http\Controllers\API;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeAPIController extends APIController
{
    private $validationRules = [
        'first_name' => 'required|string|max:30',
        'last_name' => 'required|string|max:30',
        'job_title' => 'string|max:60',
        'site_id' => 'numeric|nullable',
        'email' => 'email|nullable',
        'phone' => 'string|nullable|max:16',
        'mobile' => 'string|nullable|max:16',
        'description' => 'string|nullable|max:500'
    ];
     /**
     * List
     *
     * Get list of all employees
     * @authenticated
     * @response {}
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function index(Request $request)
    {
        $withTrashed = !!$request->input('with_trashed');

        $employees = Employee::select('id', 'first_name', 'last_name', 'job_title', 'site_id', 'deleted_at')
                        ->withTrashed($withTrashed)
                        ->with(array('site' => function($query) {
                            $query->select('id', 'name');
                        }))
                        ->withCount('assets')
                        ->get();

        return $this->sendSuccessResponse(__('employees.fetch_success'), $employees);
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

        $employee = Employee::create($data);

        return $this->sendSuccessResponse(__('employees.store_success'), $employee);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::withTrashed()->findOrFail($id);

        return $this->sendSuccessResponse(__('employees.fetch_success'), $employee);
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

        $employee = Employee::withTrashed()->findOrFail($id);


        if( 'restore' === $request->input('action')) {
            $employee->restore();
            return $this->sendSuccessResponse(__('employees.restore_success'), $employee);
        }

        $data = $request->validate($this->validationRules);

        //update code

        return $this->sendSuccessResponse(__('employees.update_success'), $employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($employeeId, Request $request)
    {
        $employee = Employee::withTrashed()->find($employeeId);

        if(empty($employee))
            return $this->sendErrorResponse(__('employees.destroy_not_found'), null, 404);

        if('true' === $request->input('permanently')) {
            $employee->forceDelete();
            return $this->sendSuccessResponse(__('employees.destroy_p_success'));
        }

        $employee->delete();
        return $this->sendSuccessResponse(__('employees.destroy_success'));
    }
}
