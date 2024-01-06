<?php

namespace App\Livewire;

use App\Models\Campus;
use App\Models\Course;
use App\Models\Grantee;
use App\Models\Student;
use Livewire\Component;
use App\Models\Barangay;
use App\Models\Province;
use App\Models\Municipal;
use App\Traits\Variables;
use App\Models\SchoolYear;
use App\Models\ScholarshipName;

class EditGrantee extends Component
{
    use Variables;
    public $editId;
    public $editStudent;
    public $fundSources1;
    public $fundSources2;

    public $showNewInput = false;

    public function toggleNewInput($show = true)
    {
        $this->showNewInput = $show;
    }


    public function mount($editId)
    {
        $this->editStudent = Student::with('grantees')
            ->findOrFail($editId);

        // Simplified data assignment from eager loaded relationships
        $this->student_id = $this->editStudent->student_id;
        $this->lastname = $this->editStudent->lastname;
        $this->firstname = $this->editStudent->firstname;
        $this->initial = $this->editStudent->initial;
        $this->email = $this->editStudent->email;
        $this->sex = $this->editStudent->sex;
        $this->status = $this->editStudent->status;
        $this->contact = $this->editStudent->contact;
        $this->studentType = $this->editStudent->studentType;
        $this->nameSchool = $this->editStudent->nameSchool;
        $this->lastYear = $this->editStudent->lastYear;
        $this->level = $this->editStudent->level;
        $this->father = $this->editStudent->father;
        $this->mother = $this->editStudent->mother;

        // joined
        $this->selectedCampus = $this->editStudent->campus;
        $this->selectedCourse  = $this->editStudent->course;
        $this->selectedBarangay = $this->editStudent->barangay;
        $this->selectedMunicipality = $this->editStudent->municipal;
        $this->selectedProvince = $this->editStudent->province;
        // end


        // Optimized Grantee Handling
        $grantees = $this->editStudent->grantees;
        if ($grantees->isNotEmpty()) {
            $this->school_year = $grantees->firstWhere('student_id', $editId)->school_year ?? "No data";
            $this->semester = $grantees->firstWhere('student_id', $editId)->semester ?? "No data";
            $this->selectedScholarshipType1 = $grantees->firstWhere('student_id', $editId)->scholarship_type ?? "No data";
            $this->selectedfundsources1 = $grantees->firstWhere('student_id', $editId)->scholarship_name ?? "No data";

            // Conditional Fund Sources based on Grantee count
            if ($grantees->count() > 1) {
                $secondGrantee = $grantees[1];
                $this->selectedScholarshipType2 = $secondGrantee->scholarship_type ?? "No data";
                $this->selectedfundsources2 = $secondGrantee->scholarship_name ?? "No data";
            } else {
                $this->selectedScholarshipType2 = null;
                $this->selectedfundsources2 = null;
            }
        } else {
            $this->school_year = "No data";
            $this->semester = "No data";
            $this->selectedScholarshipType1 = "No data";
            $this->selectedfundsources1 = "No data";
            $this->selectedScholarshipType2 = "No data";
            $this->selectedfundsources2 = "No data";
        }

        // Other data retrieval
        $this->provinces = Province::where('regCode', 01)->get();
        $this->fetchSchoolYears();
        $this->fundSources1 = ScholarshipName::where('scholarship_type', $this->selectedScholarshipType1)
        ->where('status', 0)
        ->get();

        $this->fundSources2 = ScholarshipName::where('scholarship_type', $this->selectedScholarshipType2)
        ->where('status', 0)
        ->get();

        // Update component when related data changes
        // $this->refresh();
    }

    public function updatedScholarshipType1($value)
    {
        $this->selectedfundsources1 = null;
    }
    public function updatedScholarshipType2($value)
    {
        $this->selectedfundsources2 = null;
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

    public function fetchSchoolYears()
    {
        $this->years = SchoolYear::orderBy('school_year', 'desc')->limit(5)->get();
    }


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
        return view('livewire.edit-grantee',
        [
            'provinces' => $this->provinces,
            // 'years' => $this->years,
            'fundSources1' => $this->fundSources1,
            'fundSources2' => $this->fundSources2,
            'editStudent' => $this->editStudent,
        ])->extends('layouts.includes.index')
        ->section('content');
    }


    // updated

    public function updateStudent()
    {

    }
}
