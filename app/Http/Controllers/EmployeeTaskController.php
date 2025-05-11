<?php

namespace App\Http\Controllers;

use App\Models\EmployeeTask;
use Illuminate\Http\Request;

class EmployeeTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EmployeeTask::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'employee_name' => 'required|string',
            'task_description' => 'required|string',
            'date' => 'required|date',
            'hours_spent' => 'required|integer',
            'hourly_rate' => 'required|numeric',
            'additional_charges' => 'nullable|numeric',
        ]);

        $data['total_remuneration'] = $this->calculateRemuneration(
            $data['hours_spent'],
            $data['hourly_rate'],
            $data['additional_charges'] ?? 0
        );

        return EmployeeTask::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeTask $employeeTask)
    {
        return $employeeTask;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $employeeTask = EmployeeTask::findOrFail($id);
        
        $data = $request->validate([
            'employee_name' => 'sometimes|string',
            'task_description' => 'sometimes|string',
            'date' => 'sometimes|date',
            'hours_spent' => 'sometimes|integer',
            'hourly_rate' => 'sometimes|numeric',
            'additional_charges' => 'nullable|numeric',
        ]);

        if (isset($data['hours_spent']) || isset($data['hourly_rate']) || isset($data['additional_charges'])) {
            $data['total_remuneration'] = $this->calculateRemuneration(
                $data['hours_spent'] ?? $employeeTask->hours_spent,
                $data['hourly_rate'] ?? $employeeTask->hourly_rate,
                $data['additional_charges'] ?? $employeeTask->additional_charges ?? 0
            );
        }

        $employeeTask->update($data);
        return $employeeTask;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employeeTask = EmployeeTask::findOrFail($id);
        $employeeTask->delete();
        return response()->noContent();
    }


    private function calculateRemuneration($hoursSpent, $hourlyRate, $additionalCharges)
    {
        return ($hoursSpent * $hourlyRate) + $additionalCharges;
    }
}
