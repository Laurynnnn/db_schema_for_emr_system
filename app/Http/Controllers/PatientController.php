<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'required|date',
            'phone_number' => 'nullable|string|min:10|max:10',
            'next_of_kin_name' => 'required|string|min:2|max:50',
            'next_of_kin_relationship' => 'required|in:mother,father,brother,sister,daughter,son,uncle,aunt',
            'next_of_kin_phone_number' => 'nullable|string|min:10|max:10',
        ]);

        Patient::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'gender' => $validatedData['gender'],
            'date_of_birth' => $validatedData['date_of_birth'],
            'phone_number' => $validatedData['phone_number'],
            'next_of_kin_name' => $validatedData['next_of_kin_name'],
            'next_of_kin_relationship' => $validatedData['next_of_kin_relationship'],
            'next_of_kin_phone_number' => $validatedData['next_of_kin_phone_number'],
        ]);

        return redirect()->route('patients.index')->with('success', 'Patient created successfully.');
    }

    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        
        // Validate and update the patient
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'date_of_birth' => 'required|date',
            'phone_number' => 'nullable|string',
            'next_of_kin_name' => 'required|string|max:255',
            'next_of_kin_relationship' => 'required|string|max:255',
            'next_of_kin_phone_number' => 'required|string',
        ]);
    
        $patient->update($request->all());
    
        return redirect()->route('patients.index')->with('success', 'Patient updated successfully');
    }
    

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient deleted successfully.');
    }

    public function reactivate($id)
    {
        $patient = Patient::withTrashed()->find($id);
        $patient->restore();
        return redirect()->route('patients.index')->with('success', 'Patient reactivated successfully.');
    }
}
