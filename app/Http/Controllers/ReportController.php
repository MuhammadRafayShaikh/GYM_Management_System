<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Attendance;
use App\Models\Staff_Member;
use App\Models\Membership;
use App\Models\Group;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function reportView()
    {
        return view('attendance-report');
    }

    public function reports(Request $request)
    {
        $members = Attendance::with('group', 'member')->whereBetween('attendance_date', [$request->start_date, $request->end_date])->orderBy('attendance_date', 'ASC')->get();
        return response()->json([
            'members' => $members
        ]);
    }

    public function memberAttendancePDF(Request $request)
    {
        $members = Attendance::with('group', 'member')->whereBetween('attendance_date', [$request->start_date, $request->end_date])->orderBy('attendance_date', 'ASC')->get();

        $pdf = Pdf::loadView('pdf.memberAttendancePDF', compact('members'));

        return $pdf->download('Members_Attendance.pdf');
    }


    public function dashboard()
    {
        $total_members = Member::count();
        $total_staffs = Staff_Member::count();
        $total_groups = Group::count();
        $total_memberships = Membership::count();

        return view('dashboard', compact('total_members','total_staffs','total_groups','total_memberships'));
    }
}
