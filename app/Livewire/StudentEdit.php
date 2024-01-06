<?php

namespace App\Livewire;

use App\Models\Campus;
use App\Models\Course;
use App\Models\Grantee;
use App\Models\Student;
use Livewire\Component;
use App\Models\AuditLog;
use App\Models\Barangay;
use App\Models\Province;
use App\Models\Municipal;
use App\Traits\Variables;
use App\Models\SchoolYear;
use App\Models\Notification;
use App\Models\ScholarshipName;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class StudentEdit extends Component
{
    use Variables;
    public $studentId, $student, $scholarship_name, $scholarship_type;
    public $noStudentRecord = false;
    public $existingStudent;
    public $fundSources1;
    public $fundSources2;
    public $scholarshipsCreated;

    protected $rules = [
        'student_id' => 'required',
        'semester' => 'required',
        'school_year' => 'required',
        'selectedScholarshipType1' => 'required_without:selectedScholarshipType2',
        'selectedfundsources1' => 'required_with:selectedScholarshipType1',
        'selectedScholarshipType2' => 'required_without:selectedScholarshipType1',
        'selectedfundsources2' => 'required_with:selectedScholarshipType2',
    ];

    public function fetchSchoolYears()
    {
        $this->years = SchoolYear::orderBy('school_year', 'desc')->limit(5)->get();
    }

    public function mount($rowId)
    {
        $this->student = $rowId;
        // Load the student details based on $rowId
        $this->student = Student::findOrFail($rowId);


            $this->student_id = $this->student->student_id;
            $this->lastname= $this->student->lastname;
            $this->firstname= $this->student->firstname;
            $this->initial= $this->student->initial;
            $this->email= $this->student->email;
            $this->sex= $this->student->sex;
            $this->status= $this->student->status;
            // Use join to get the related models
            $this->selectedBarangay = Barangay::join('students', 'barangays.brgyCode', '=', 'students.barangay')
                ->where('students.id', $this->student->id)
                ->value('brgyDesc') ?? "No data";

            $this->selectedMunicipality = Municipal::join('students', 'municipals.citymunCode', '=', 'students.municipal')
                ->where('students.id', $this->student->id)
                ->value('citymunDesc') ?? "No data";

            $this->selectedProvince = Province::join('students', 'provinces.provCode', '=', 'students.province')
                ->where('students.id', $this->student->id)
                ->value('provDesc') ?? "No data";

            $this->selectedCampus = Campus::join('students', 'campuses.id', '=', 'students.campus')
            ->where('students.id', $this->student->id)
            ->value('campusDesc') ?? "No data";

            $this->selectedCourse = Course::join('students', 'courses.course_id', '=', 'students.course')
            ->where('students.id', $this->student->id)
            ->value('course_name') ?? "No data";

            $this->level= $this->student->level;
            $this->father= $this->student->father;
            $this->mother= $this->student->mother;
            $this->contact= $this->student->contact;
            $this->studentType= $this->student->studentType;
            $this->nameSchool = $this->student->nameSchool ?? "No data";
            $this->lastYear= $this->student->lastYear ?? "No data";

    $grantees = Grantee::where('student_id', $rowId)->get();

    if ($grantees->isNotEmpty()) {
        $this->school_year = $grantees->first()->school_year;
        $this->semester = $grantees->first()->semester;
        $this->selectedScholarshipType1 = $grantees->first()->scholarship_type;
        $this->selectedfundsources1 = $grantees->first()->scholarship_name;

        if ($grantees->count() > 1) {
            $secondGrantee = $grantees[1];
            $this->selectedScholarshipType2 = $secondGrantee->scholarship_type;
            $this->selectedfundsources2 = $secondGrantee->scholarship_name;
        } else {
            // Set default values when there's only one or no grantees
            $this->selectedScholarshipType2 = null;
            $this->selectedfundsources2 = null;
        }
        } else {
            // Set default values when there are no grantees
            $this->school_year = "No data";
            $this->semester = "No data";
            $this->selectedScholarshipType1 = "No data";
            $this->selectedfundsources1 = "No data";
            $this->selectedScholarshipType2 = "No data";
            $this->selectedfundsources2 = "No data";
        }



            $this->provinces = Province::where('regCode', 01)->get();

            $this->fundSources1 = ScholarshipName::where('scholarship_type', $this->selectedScholarshipType1)
            ->where('status', 0)
            ->get();

            $this->fundSources2 = ScholarshipName::where('scholarship_type', $this->selectedScholarshipType2)
            ->where('status', 0)
            ->get();
        }

        public function updatedSelectedScholarshipType1($value)
        {
            $this->fundSources1 = ScholarshipName::where('scholarship_type', $value)
                ->where('status', 0)
                ->get();
        }
        public function updatedSelectedScholarshipType2($value)
        {
            $this->fundSources2 = ScholarshipName::where('scholarship_type', $value)
                ->where('status', 0)
                ->get();
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


    public function studentSearch()
    {
        $this->existingStudent = null; // Reset student data initially
        $this->noStudentRecord = false; // Reset error flag

        $studentId = $this->student_id;

        // Perform the student search logic based on the role and campus restrictions:
        if (auth()->user()->role === 0 || auth()->user()->role === 1) {
            $this->existingStudent = Student::with('grantees')
                ->where('student_id', $studentId)
                ->first();
        } else {
            $this->existingStudent = Student::with('grantees')
                ->where('student_id', $studentId)
                ->where('campus', 1)
                ->first();

            // Add validation for users with roles other than 0 or 1
            if ($this->existingStudent && $this->existingStudent->campus !== 1) {
                // Handle the error or add your custom logic
                $error = 'Access Denied!';
                session()->flash('error', $error);
            }
        }

        if (!$this->existingStudent) {
            $this->noStudentRecord = true;
        } else {
            // If a student is found, display sample data:
            $this->lastname = $this->existingStudent->lastname;
            $this->firstname = $this->existingStudent->firstname;
            $this->initial = $this->existingStudent->initial;
            $this->sex = $this->existingStudent->sex;
            $this->status = $this->existingStudent->status;
            $this->email = $this->existingStudent->email;
            $this->contact = $this->existingStudent->contact;

            $this->selectedCampus = Campus::join('students', 'campuses.id', '=', 'students.campus')
                ->where('students.id', $this->existingStudent->id)
                ->value('campusDesc') ?? "No data";
            $this->selectedCourse = Course::join('students', 'courses.course_id', '=', 'students.course')
                ->where('students.id', $this->existingStudent->id)
                ->value('course_name') ?? "No data";

            $this->studentType = $this->existingStudent->studentType;
            $this->nameSchool = $this->existingStudent->nameSchool ?? "No Data";
            $this->lastYear = $this->existingStudent->lastYear ?? "No Data";

            $this->selectedBarangay = Barangay::join('students', 'barangays.brgyCode', '=', 'students.barangay')
                ->where('students.id', $this->existingStudent->id)
                ->value('brgyDesc') ?? "No data";

            $this->selectedMunicipality = Municipal::join('students', 'municipals.citymunCode', '=', 'students.municipal')
                ->where('students.id', $this->existingStudent->id)
                ->value('citymunDesc') ?? "No data";

            $this->selectedProvince = Province::join('students', 'provinces.provCode', '=', 'students.province')
                ->where('students.id', $this->existingStudent->id)
                ->value('provDesc') ?? "No data";

            $this->level = $this->existingStudent->level;
            $this->father = $this->existingStudent->father;
            $this->mother = $this->existingStudent->mother;

            $grantees = $this->existingStudent->grantees;  // Retrieve all grantees at once

            if ($grantees->isNotEmpty()) {

                $this->school_year = $grantees->first()->school_year;
                $this->semester = $grantees->first()->semester;

                $this->selectedScholarshipType1 = $grantees->first()->scholarship_type;
                $this->selectedfundsources1 = $grantees->first()->scholarship_name;

                if ($grantees->count() > 1) {
                    $secondGrantee = $grantees->get(1);
                    $this->selectedScholarshipType2 = $secondGrantee->scholarship_type;
                    $this->selectedfundsources2 = $secondGrantee->scholarship_name;
              } else {
                // Set default values when there's only one or no grantees
                $this->selectedScholarshipType2 = null;
                $this->selectedfundsources2 = null;
            }
        } else {
            // Set default values when there are no grantees
            $this->school_year = null; // or provide a default value
            $this->semester = null;
            $this->selectedScholarshipType1 = null;
            $this->selectedfundsources1 = null;
            $this->selectedScholarshipType2 = null;
            $this->selectedfundsources2 = null;
              }

            }

    }

    public function render()
    {

     $this->fetchSchoolYears();

        return view('livewire.student-edit',[
            'years' => $this->years,
            'fundSources1' => $this->fundSources1,
            'fundSources2' => $this->fundSources2,
            'student' => $this->student,
            'existingStudent' => $this->existingStudent,
            'noStudentRecord' => $this->noStudentRecord,
            'provinces' => $this->provinces,
        ])->extends('layouts.includes.index')
          ->section('content');
    }


    public function addScholarship()
    {

        $this->validate();

        // Gather valid scholarship details
        $scholarshipsToCreate = collect([
            ['type' => $this->selectedScholarshipType1, 'name' => $this->selectedfundsources1],
            ['type' => $this->selectedScholarshipType2, 'name' => $this->selectedfundsources2],
        ])->filter(function ($scholarship) {
            return $scholarship['type'] !== null && $scholarship['name'] !== null;
        });


      // Create or update Grantee records for each scholarship
    $scholarshipsCreatedCount = 0;
    foreach ($scholarshipsToCreate as $scholarship) {
        // Check for existing record with matching student_id, scholarship_type, and scholarship_name
        $granteeExists = Grantee::where([
            'student_id' => $this->student->id,
            'scholarship_type' => $scholarship['type'],
            'scholarship_name' => $scholarship['name'],
        ])->exists();

        // Create a new Grantee record if it doesn't exist yet, or update existing record
        if (!$granteeExists) {
            Grantee::create([
                'student_id' => $this->student->id,
                'school_year' => $this->school_year,
                'semester' => $this->semester,
                'scholarship_type' => $scholarship['type'],
                'scholarship_name' => $scholarship['name'],
            ]);
            $scholarshipsCreatedCount++;
        } else {
            // Optionally update school_year and semester if needed
            Grantee::where([
                'student_id' => $this->student->id,
                'scholarship_type' => $scholarship['type'],
                'scholarship_name' => $scholarship['name'],
            ])->update([
                'school_year' => $this->school_year,
                'semester' => $this->semester,
            ]);
        }
    }

        Notification::create([
            'user_id' => auth()->id(),
            'data' => ('added_by ' . auth()->user()->getRoleText()), // Store role text
        ]);
        
        // Display appropriate success message
        $message = $scholarshipsCreatedCount > 1
            ? 'New grantees have been added successfully!'
            : ($scholarshipsCreatedCount > 0 ? 'New grantee has been added successfully!' : 'No changes made.');
            
        session()->flash('success', $message);


        // Log the action
        $user = Auth::user();
        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'Added ' . $this->firstname . ' ' . $this->lastname . ' as a new scholar',
            'data' => json_encode(['Added by ' . '' . Auth::user()->name]),
        ]);
        // $this->dispatch('refreshComponent');

    }


}
