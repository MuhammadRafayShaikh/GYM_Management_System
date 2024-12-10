<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Group;
use App\Mail\staffmail;
use App\Models\Attendance;
use App\Models\Staff_Member;
use Illuminate\Http\Request;
use App\Models\Specialization;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Staff_Attendance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class StaffMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $staffmembers = DB::table('staff_members')
            ->join('specializations', function ($join) {
                $join->on(DB::raw("FIND_IN_SET(specializations.id, staff_members.specialization)"), '>', DB::raw('0'));
            })
            ->join('roles', function ($join) {
                $join->on(DB::raw("FIND_IN_SET(roles.id, staff_members.role)"), '>', DB::raw('0'));
            })
            ->select(
                'staff_members.id',
                'staff_members.fname',
                'staff_members.lname',
                'staff_members.image',
                'staff_members.gender',
                'staff_members.birth',
                'staff_members.address',
                'staff_members.city',
                'staff_members.state',
                'staff_members.phone',
                'staff_members.email',
                DB::raw('GROUP_CONCAT(DISTINCT specializations.name) as specializations'),
                DB::raw('GROUP_CONCAT(DISTINCT roles.name) as roles')
            )
            ->groupBy(
                'staff_members.id',
                'staff_members.fname',
                'staff_members.lname',
                'staff_members.image',
                'staff_members.gender',
                'staff_members.birth',
                'staff_members.address',
                'staff_members.city',
                'staff_members.state',
                'staff_members.phone',
                'staff_members.email'
            )
            ->get();


        // return $staffmembers;

        return response()->json([
            'status' => true,
            'message' => 'All Staff Members',
            'staffmembers' => $staffmembers
        ], 200);
    }

    public function staffPDF()
    {

        $staffmembers = DB::table('staff_members')
            ->join('specializations', function ($join) {
                $join->on(DB::raw("FIND_IN_SET(specializations.id, staff_members.specialization)"), '>', DB::raw('0'));
            })
            ->join('roles', function ($join) {
                $join->on(DB::raw("FIND_IN_SET(roles.id, staff_members.role)"), '>', DB::raw('0'));
            })
            ->select(
                'staff_members.id',
                'staff_members.fname',
                'staff_members.lname',
                'staff_members.image',
                'staff_members.gender',
                'staff_members.birth',
                'staff_members.address',
                'staff_members.city',
                'staff_members.state',
                'staff_members.phone',
                'staff_members.email',
                DB::raw('GROUP_CONCAT(DISTINCT specializations.name) as specializations'),
                DB::raw('GROUP_CONCAT(DISTINCT roles.name) as roles')
            )
            ->groupBy(
                'staff_members.id',
                'staff_members.fname',
                'staff_members.lname',
                'staff_members.image',
                'staff_members.gender',
                'staff_members.birth',
                'staff_members.address',
                'staff_members.city',
                'staff_members.state',
                'staff_members.phone',
                'staff_members.email'
            )
            ->get();


        $pdf = Pdf::loadView('pdf.staffPDF', compact('staffmembers'));

        return $pdf->download('All_Staff.pdf');
    }
    public function staffmember()
    {
        return view('staff-member');
    }

    public function create()
    {

        $special = Specialization::all();
        $role = Role::all();
        return view('add-staff', compact('special', 'role'));
    }
    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        // return $request;
        // return $request;
        // return $request->file('image')->getClientOriginalName();
        // $ids = [$request->special];
        // $specialId = implode(', ', $request->special);
        // $roleId = implode(', ', $request->role);
        // return $multipleId;
        $staffmemberValidation = validator($request->all(), [
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'fname' => 'required',
            'lname' => 'required',
            'gender' => 'required',
            'birth' => 'required',
            'role' => 'required',
            'special' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email'
        ]);

        if ($staffmemberValidation->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed',
                'error' => $staffmemberValidation->errors()->all()
            ], 401);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageExtension = $image->getClientOriginalExtension();
            $imagename = time() . '.' . $imageExtension;
            $image->move(public_path('uploads'), $imagename);
        } else {
            $imagename = null;
        }
        $staffmember = Staff_Member::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'image' => $imagename,
            'gender' => $request->gender,
            'birth' => $request->birth,
            'role' => implode(', ', $request->role),
            'specialization' => implode(', ', $request->special),
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        Mail::to($request->email)->send(new staffmail("Welcome to our GYM", "You are a Staff of our GYM"));

        if ($staffmember) {
            return response()->json([
                'status' => true,
                'message' => 'Staff Member Added',
                'group' => $staffmember
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Staff Member Not Added'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $staffmember = Staff_Member::find($id);
        $specialId = explode(', ', $staffmember->specialization);
        return $specialId[1];
    }

    public function edit(string $id)
    {
        $staffmember = Staff_Member::find($id);

        // Multiple IDs ko array mein convert karna
        $specialIds = explode(', ', $staffmember->specialization);
        $roleIds = explode(', ', $staffmember->role);

        // Saare specializations ko fetch karna
        $specializations = Specialization::all();
        $roles = Role::all();

        return view('update-staff', compact('staffmember', 'specialIds', 'roleIds', 'specializations', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return $request;
        // return $request->file('new_image');
        $staffmemberValidation = validator($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'new_image' => 'image|mimes:jpg,jpeg,png,gif',
            'gender' => 'required',
            'birth' => 'required',
            'role' => 'required',
            'special' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email'
        ]);

        if ($staffmemberValidation->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed',
                'error' => $staffmemberValidation->errors()->all()
            ], 401);
        }

        $staffmember = Staff_Member::find($id);

        if ($request->hasFile('new_image')) {
            $path = public_path('uploads/');
            if ($staffmember->image && file_exists($path . $staffmember->image)) {
                unlink($path . $staffmember->image);
            }

            $file = $request->file('new_image');
            $fileExtension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $fileExtension;
            $file->move($path, $filename);
        } else if ($request->imageDropdown == 1) {
            $remove = $staffmember->image = null;
            $filename = $remove;
            // return $filename;
        } else {
            $filename = $staffmember->image;
        }
        $staffmember->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'image' => $filename,
            'gender' => $request->gender,
            'birth' => $request->birth,
            'role' => implode(', ', $request->role),
            'specialization' => implode(', ', $request->special),
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        if ($staffmember) {
            return response()->json([
                'status' => true,
                'message' => 'Staff Member Updated',
                'categories' => $staffmember
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Staff Member Not Updated'
            ], 400);
        }
    }

    public function staffAttendance()
    {
        return view('staff-attendance');
    }

    public function getStaffAttendance(Request $request)
    {
        $staff_members = Staff_Member::orderBy('id', 'DESC')->get();
        $attendance_records = Staff_Attendance::where('attendance_date', $request->staffdate)->get()->keyBy('staff_id');

        return response()->json([
            'status' => true,
            'message' => 'All Staff Members',
            'staff_members' => $staff_members,
            'attendance_records' => $attendance_records,
        ], 200);
    }


    public function updateStaffAttendance(Request $request)
    {
        $staffValidation = validator($request->all(), [
            'staff_memberId' => 'required',
            'staffdate' => 'required',
            'status' => 'required'
        ]);

        if ($staffValidation->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed',
                'error' => $staffValidation->errors()->all()
            ], 400);
        }

        $attendance = Staff_Attendance::updateOrCreate(
            [
                'staff_id' => $request->staff_memberId,
                'attendance_date' => $request->staffdate,
            ],
            [
                'status' => $request->status
            ]
        );

        if ($attendance) {
            return response()->json([
                'status' => true,
                'message' => 'Staff Attendance Marked Successfully',
                'attendance' => $attendance
            ], 200);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
