<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company as RequestsCompany;
use App\Models\Company;
use App\Models\Employee;

class CompanyController extends Controller
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
                'data' => Company::paginate(10)
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
    public function store(RequestsCompany $request)
    {
        $company = new Company;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file_path = $file->storeAs('app/public', $fileName, 'public');
            $company->logo = $file_path;
        }

        if ($company->save()) {
            $error = 0;
            $message = 'Company added';
            $data = $company;
        } else {
            $error = 1;
            $message = 'Some Error Occurred | Company not added';
            $data = [];
        }

        return response()->json(compact('error','message','data'), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return response()->json(
            [
                'error' => 0,
                'message' => 'success',
                'data' => $company
            ],
            200
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsCompany $request, Company $company)
    {
        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file_path = $file->storeAs('app/public', $fileName, 'public');
            $company->logo = $file_path;
        }

        if ($company->save()) {
            $error = 0;
            $message = 'Company updated';
            $data = $company;
        } else {
            $error = 1;
            $message = 'Some Error Occurred | Company not updated';
            $data = [];
        }

        return response()->json(compact('error','message','data'), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company_id = $company->id;

        if ($company->delete()) {

            Employee::whereCompanyId($company_id)->delete();

            return response()->json(
                [
                    'error' => 0,
                    'message' => 'Company and all of its employees are deleted'
                ],
                200
            );

        } else {

            return response()->json(
                [
                    'error' => 1,
                    'message' => 'Some Error Occurred | Company not deleted'
                ],
                200
            );
        }
    }
}
