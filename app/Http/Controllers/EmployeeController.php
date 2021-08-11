<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee as RequestsEmployee;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            [
                'error' => 0,
                'message' => 'success',
                'data' => Employee::paginate(10)
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsEmployee $request)
    {
        $employee = new Employee();
        $employee->company_id = $request->company_id;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;

        if ($employee->save()) {
            $error = 0;
            $message = 'Employee added';
            $data = $employee;
        } else {
            $error = 1;
            $message = 'Some Error Occurred | Employee not added';
            $data = [];
        }

        return response()->json( compact('error','message','data'), 200 );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return response()->json(
            [
                'error' => 0,
                'message' => 'success',
                'data' => $employee
            ],
            200
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsEmployee $request, Employee $employee)
    {
        $employee->company_id = $request->company_id;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;

        if ($employee->save()) {
            $error = 0;
            $message = 'Employee updated';
            $data = $employee;
        } else {
            $error = 1;
            $message = 'Some Error Occurred | Employee not updated';
            $data = [];
        }

        return response()->json( compact('error','message','data'), 200 );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        if ($employee->delete()) {
            
            return response()->json(
                [
                    'error' => 0,
                    'message' => 'Employee is deleted'
                ],
                200
            );

        } else {

            return response()->json(
                [
                    'error' => 1,
                    'message' => 'Some Error Occurred | Employee not deleted'
                ],
                200
            );
        }
    }
}
