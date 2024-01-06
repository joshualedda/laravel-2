<?php

namespace App\Livewire;

use App\Models\Campus;
use Livewire\Component;
use App\Models\Barangay;
use App\Models\Province;
use App\Models\Municipal;
use App\Traits\Variables;
use App\Models\SchoolYear;
use App\Models\ScholarshipName;

class Reports extends Component
{
    use Variables;
    public $campuses, $selectedScholarshipType, $selectedfundsources, $fundsources;

    public function mount()
    {
        $this->provinces = Province::where('regCode', 01)->get();
        $this->fundsources = ScholarshipName::where('scholarship_type', $this->selectedScholarshipType)
        ->where('status', 0)
        ->get();
    }

    public function updatedSelectedScholarshipType($value)
    {
        $this->fundsources = ScholarshipName::where('scholarship_type', $value)
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
    public function fetchSchoolYears()
    {
        $this->years = SchoolYear::orderBy('school_year', 'asc')->limit(5)->get();
    }


    public function render()
    {

        $this->fetchSchoolYears();

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

        return view('livewire.reports',[
            'years' => $this->years,
            'fundsources' => $this->fundsources,
            'provinces' => $this->provinces,
        ])->extends('layouts.includes.index')
        ->section('content');
    }
}
