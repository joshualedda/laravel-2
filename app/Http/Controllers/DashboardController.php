<?php

namespace App\Http\Controllers;

use App\Models\Grantee;
use App\Models\Student;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\ScholarshipName;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public $fundSources, $selectedSources;
    public $years, $selectedYear;

    public function index()
    {
        $fundSources = ScholarshipName::all();
        $years = SchoolYear::orderBy('school_year', 'desc')->distinct()->limit(5)->get();

        return view('dashboard', compact('fundSources', 'years'));
    }




    public function filterData(Request $request)
    {
          // Store selected values from the request (if available)
          $this->selectedSources = $request->input('selectedSources', null);
          $this->selectedYear = $request->input('selectedYear', null);

          // Retrieve student counts based on selected filters (or all if none selected)
          $studentCount = $this->getFilteredStudentCount();

          // Get all campus names
          $allCampuses = DB::table('campuses')->pluck('campus_name');

          // Combine student counts with all campuses, filling in 0 values
          $studentCountByCampus = $allCampuses->map(function ($campusName) use ($studentCount) {
              $matchingCount = $studentCount->firstWhere('campus_name', $campusName);

              return [
                  'campus_name' => $campusName,
                  'student_count' => $matchingCount ? $matchingCount->student_count : 0
              ];
          });

        // Return filtered data as JSON
        return response()->json($studentCountByCampus);
    }


    private function getFilteredStudentCount()
    {
        if (empty($this->selectedSources) && empty($this->selectedYear)) {
            // Retrieve all student counts
            return DB::table('grantees as g')
                ->join('students as s', 'g.student_id', '=', 's.id')
                ->join('campuses as c', 's.campus', '=', 'c.id')
                ->select('c.campus_name', DB::raw('COUNT(DISTINCT g.student_id) as student_count'))
                ->groupBy('c.campus_name')
                ->get();
        } else {
            // Retrieve filtered student counts
            return DB::table('grantees as g')
                ->join('students as s', 'g.student_id', '=', 's.id')
                ->join('campuses as c', 's.campus', '=', 'c.id')
                ->select('c.campus_name', DB::raw('COUNT(DISTINCT g.student_id) as student_count'))
                ->where('g.scholarship_name', '=', $this->selectedSources)
                ->where('g.school_year', '=', $this->selectedYear)
                ->groupBy('c.campus_name')
                ->get();
        }
    }






















}
