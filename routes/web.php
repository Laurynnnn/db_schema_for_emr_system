<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PatientController, MedicalRecordController, LabTestController, DiagnosisController, DrugController,
    PrescriptionController, AppointmentController, ClinicController, UserController
};

Route::get('/test', function () {
    return view('patients.index');
});

Route::resource('patients', PatientController::class);
Route::resource('medical-records', MedicalRecordController::class);
Route::resource('lab-tests', LabTestController::class);
Route::resource('diagnoses', DiagnosisController::class);
Route::resource('drugs', DrugController::class);
Route::resource('prescriptions', PrescriptionController::class);
Route::resource('appointments', AppointmentController::class);
Route::resource('clinics', ClinicController::class);
Route::resource('users', UserController::class);


Route::get('/', function () {
    return view('welcome');
});
