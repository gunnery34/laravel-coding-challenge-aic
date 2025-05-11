<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeTaskController;

Route::apiResource('tasks', EmployeeTaskController::class);