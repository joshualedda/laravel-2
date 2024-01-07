<?php

namespace App\Livewire;

use App\Models\Campus;
use App\Models\Student;
use Livewire\Component;
use App\Models\AuditLog;
use App\Models\Barangay;
use App\Models\Province;
use App\Models\Municipal;
use App\Traits\Variables;
use Illuminate\Support\Facades\Auth;

class StudentInfo extends Component
{
    use Variables;
    public $studentId;
    public $existingStudent = null;
    public $noStudentRecord = false;


    protected $rules = [
        'student_id' => 'required',
        'selectedCampus' => 'required',
        'selectedCourse' => 'required',
        'lastname' => 'required',
        'firstname' => 'required',
        'initial' => 'required',
        'sex' => 'required',
        'status' => 'required',
        'selectedProvince' => 'required',
        'selectedMunicipality' => 'required',
        'selectedBarangay' => 'required',
        'contact' => 'required|min:11|max:11',
        'email' => 'required|email',
        'level' => 'required',
        'studentType' => 'required',
        'father' => 'required',
        'mother' => 'required',
    ];


    public function updatedStudentType($value)
    {
        if ($value === 'New') {
            $this->showNewInput = true;
            $this->rules['nameSchool'] = 'required';
            $this->rules['lastYear'] = 'required|numeric';
        } else {
            $this->showNewInput = false;
            $this->rules['nameSchool'] = 'nullable';
            $this->rules['lastYear'] = 'nullable';
        }
    }

    public $showNewInput = false;

    public function toggleNewInput($show = true)
    {
        $this->showNewInput = $show;
    }

    // save student
    public function saveStudent()
    {
        $this->validate();

                // Save the student data to the database
                $student = Student::create([
                    'student_id' => $this->student_id,
                    'lastname' => $this->lastname,
                    'firstname' => $this->firstname,
                    'initial' => $this->initial,
                    'email' => $this->email,
                    'sex' => $this->sex,
                    'status' => $this->status,
                    'barangay' => $this->selectedBarangay,
                    'municipal' => $this->selectedMunicipality,
                    'province' => $this->selectedProvince,
                    'campus' => $this->selectedCampus,
                    'course' => $this->selectedCourse,
                    'level' => $this->level,
                    'father' => $this->father,
                    'mother' => $this->mother,
                    'contact' => $this->contact,
                    'studentType' => $this->studentType,
                    'nameSchool' => $this->nameSchool,
                    'lastYear' => $this->lastYear,
                ]);


                // Display success message
                session()->flash('success', 'Student data saved successfully.');

                    // Reset form fields
                    $this->resetForm();

                    $user = Auth::user();
                    AuditLog::create([
                        'user_id' => $user->id,
                        'action' => 'Added a new student',
                        'data' => json_encode('Added by '. $user->name),
                    ]);
    }

    // seach

    public function studentSearch()
    {
        $this->existingStudent = null; // Reset student data initially
        $this->noStudentRecord = false; // Reset error flag

        $studentId = $this->student_id;
        
        // Perform the student search logic based on the role and campus restrictions:
        if (auth()->user()->role === 0 || auth()->user()->role === 1) {
            $this->existingStudent = Student::where('student_id', $studentId)
            ->first();
            } else {
            $this->existingStudent = Student::where('student_id', $studentId)
            ->where('campus', 1)
            ->first();

            // Add validation for users with roles other than 0 or 1
            if ($this->existingStudent && $this->existingStudent->campus !== 1 ) {
                // Handle the error or add your custom logic
                $error = 'Access Denied!';
                session()->flash('error', $error);
            }
        }
            // dd($this->existingStudent);

        if (!$this->existingStudent) {
            $this->noStudentRecord = true;
        } else {
            // dd($this->existingStudent);
            // If a student is found, display sample data:
            $this->lastname = $this->existingStudent->lastname;
            $this->firstname = $this->existingStudent->firstname;
            $this->initial = $this->existingStudent->initial;
            $this->sex = $this->existingStudent->sex;
            $this->status = $this->existingStudent->status;
            $this->email = $this->existingStudent->email;
            $this->contact = $this->existingStudent->contact;

            $this->selectedCampus = $this->existingStudent->campus;
            $this->selectedCourse  = $this->existingStudent->course;
            $this->selectedBarangay = $this->existingStudent->barangay;
            $this->selectedMunicipality = $this->existingStudent->municipal;
            $this->selectedProvince = $this->existingStudent->province;

            $this->studentType = $this->existingStudent->studentType;
            $this->nameSchool = $this->existingStudent->nameSchool ?? "No Data";
            $this->lastYear = $this->existingStudent->lastYear ?? "No Data";

            $this->level = $this->existingStudent->level;
            $this->father = $this->existingStudent->father;
            $this->mother = $this->existingStudent->mother;
            
        }
    }



        public function mount()
        {
            $this->provinces = Province::where('regCode', 01)->get();
        }

        public function updatedSelectedProvince($provinceId)
        {
            if ($provinceId) {
                $this->municipalities = Municipal::where('provCode', $provinceId)->get();
                $this->selectedMunicipality = null; // Reset municipality and barangay
                $this->barangays = [];
            } else {
                $this->municipalities = [];
                $this->selectedMunicipality = null;
                $this->barangays = [];
            }
        }

        public function updatedSelectedMunicipality($municipalityId)
        {
            if ($municipalityId) {
                $this->barangays = Barangay::where('citymunCode', $municipalityId)->get();
            } else {
                $this->barangays = [];
            }
        }

    // end
    public function render()
    {

            if (auth()->user()->role === 0 || auth()->user()->role === 1) {
                $this->campuses = Campus::all();
            } else {
                $this->campuses = Campus::where('id', 1)->get();
            }

            if ($this->selectedCampus) {
                $campus = Campus::findOrFail($this->selectedCampus);
                $this->courses = $campus->courses;
            } else {
                $this->courses = [];
            }

        return view('livewire.student-info',[
            'existingStudent' => $this->existingStudent,
            'noStudentRecord' => $this->noStudentRecord,
            'provinces' => $this->provinces,
        ])->extends('layouts.includes.index')->section('content');
    }
    private function resetForm()
    {
        // Reset all form fields and properties
        $this->reset([
            'student_id',
            'lastname',
            'firstname',
            'initial',
            'email',
            'sex',
            'status',
            'selectedBarangay',
            'selectedMunicipality',
            'selectedProvince',
            'selectedCampus',
            'selectedCourse',
            'level',
            'father',
            'mother',
            'contact',
            'studentType',
            'nameSchool',
            'lastYear',
        ]);
    }

}
