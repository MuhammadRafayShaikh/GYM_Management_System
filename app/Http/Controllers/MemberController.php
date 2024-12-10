<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Member;
use App\Mail\welcomemail;
use App\Models\Attendance;
use App\Models\Membership;
use App\Models\Staff_Member;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = DB::table('members')
            ->join('groups', function ($join) {
                $join->on(DB::raw("FIND_IN_SET(groups.id, members.group)"), '>', DB::raw('0'));
            })
            ->join('staff_members', function ($join) {
                $join->on(DB::raw("FIND_IN_SET(staff_members.id, members.staff_member)"), '>', DB::raw('0'));
            })->join('memberships', 'members.membership', '=', 'memberships.id')
            ->select(
                'members.id',
                'members.fname',
                'members.lname',
                'members.image',
                'members.gender',
                'members.birth',
                'members.address',
                'members.city',
                'members.state',
                'members.phone',
                'members.email',
                'members.weight',
                'members.height',
                'members.chest',
                'members.waist',
                'members.thigh',
                'members.arm',
                'members.fat',
                'members.membership',
                'members.start_date',
                'members.end_date',
                DB::raw('GROUP_CONCAT(DISTINCT groups.name) as groups'),
                DB::raw('GROUP_CONCAT(DISTINCT staff_members.fname, staff_members.lname) as staff_members')
            )
            ->groupBy(
                'members.id',
                'members.fname',
                'members.lname',
                'members.image',
                'members.gender',
                'members.birth',
                'members.address',
                'members.city',
                'members.state',
                'members.phone',
                'members.email',
                'members.weight',
                'members.height',
                'members.chest',
                'members.waist',
                'members.thigh',
                'members.arm',
                'members.fat',
                'members.membership',
                'members.start_date',
                'members.end_date'
            )
            ->get();


        // return $staffmembers;

        return response()->json([
            'status' => true,
            'message' => 'All Staff Members',
            'members' => $members
        ], 200);
    }

    public function memberPDF()
    {
        $members = DB::table('members')
            ->join('groups', function ($join) {
                $join->on(DB::raw("FIND_IN_SET(groups.id, members.group)"), '>', DB::raw('0'));
            })
            ->join('staff_members', function ($join) {
                $join->on(DB::raw("FIND_IN_SET(staff_members.id, members.staff_member)"), '>', DB::raw('0'));
            })->join('memberships', 'members.membership', '=', 'memberships.id')
            ->select(
                'members.id',
                'members.fname',
                'members.lname',
                'members.image',
                'members.gender',
                'members.birth',
                'members.address',
                'members.city',
                'members.state',
                'members.phone',
                'members.email',
                'members.weight',
                'members.height',
                'members.chest',
                'members.waist',
                'members.thigh',
                'members.arm',
                'members.fat',
                'members.membership',
                'members.start_date',
                'members.end_date',
                DB::raw('GROUP_CONCAT(DISTINCT groups.name) as groups'),
                DB::raw('GROUP_CONCAT(DISTINCT staff_members.fname, staff_members.lname) as staff_members')
            )
            ->groupBy(
                'members.id',
                'members.fname',
                'members.lname',
                'members.image',
                'members.gender',
                'members.birth',
                'members.address',
                'members.city',
                'members.state',
                'members.phone',
                'members.email',
                'members.weight',
                'members.height',
                'members.chest',
                'members.waist',
                'members.thigh',
                'members.arm',
                'members.fat',
                'members.membership',
                'members.start_date',
                'members.end_date'
            )
            ->get();

        // return $members;

        $pdf = Pdf::loadView('pdf.memberPDF', compact('members'));

        return $pdf->download('All_Members.pdf');
    }

    public function getmemberPDF()
    {
        $members = DB::table('members')
            ->join('groups', function ($join) {
                $join->on(DB::raw("FIND_IN_SET(groups.id, members.group)"), '>', DB::raw('0'));
            })
            ->join('staff_members', function ($join) {
                $join->on(DB::raw("FIND_IN_SET(staff_members.id, members.staff_member)"), '>', DB::raw('0'));
            })->join('memberships', 'members.membership', '=', 'memberships.id')
            ->select(
                'members.id',
                'members.fname',
                'members.lname',
                'members.image',
                'members.gender',
                'members.birth',
                'members.address',
                'members.city',
                'members.state',
                'members.phone',
                'members.email',
                'members.weight',
                'members.height',
                'members.chest',
                'members.waist',
                'members.thigh',
                'members.arm',
                'members.fat',
                'members.membership',
                'members.start_date',
                'members.end_date',
                DB::raw('GROUP_CONCAT(DISTINCT groups.name) as groups'),
                DB::raw('GROUP_CONCAT(DISTINCT staff_members.fname, staff_members.lname) as staff_members')
            )
            ->groupBy(
                'members.id',
                'members.fname',
                'members.lname',
                'members.image',
                'members.gender',
                'members.birth',
                'members.address',
                'members.city',
                'members.state',
                'members.phone',
                'members.email',
                'members.weight',
                'members.height',
                'members.chest',
                'members.waist',
                'members.thigh',
                'members.arm',
                'members.fat',
                'members.membership',
                'members.start_date',
                'members.end_date'
            )
            ->get();

        // return $members;

        return view('pdf.memberPDF', compact('members'));

        // $pdf = Pdf::loadView('pdf.memberPDF', compact('members'));

        // return $pdf->download('All_Members.pdf');
    }
    public function member()
    {
        return view('member');
    }

    public function create()
    {

        $group = Group::all();
        $staff_member = Staff_Member::all();
        // return $staff_member;
        $membership = Membership::all();
        return view('add-member', compact('group', 'staff_member', 'membership'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $memberValidation = validator($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'gender' => 'required',
            'birth' => 'required',
            'group' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'chest' => 'required|numeric',
            'waist' => 'required|numeric',
            'thigh' => 'required|numeric',
            'arm' => 'required|numeric',
            'fat' => 'required|numeric',
            'staff_member' => 'required',
            'membership' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        if ($memberValidation->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed',
                'error' => $memberValidation->errors()->all()
            ], 401);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileExtension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $fileExtension;
            $file->move(public_path('uploads/'), $file);
        } else {
            $filename = null;
        }

        $member = Member::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'image' => $filename,
            'gender' => $request->gender,
            'birth' => $request->birth,
            'group' => implode(', ', $request->group),
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'phone' => $request->phone,
            'email' => $request->email,
            'weight' => $request->weight,
            'height' => $request->height,
            'chest' => $request->chest,
            'waist' => $request->waist,
            'thigh' => $request->thigh,
            'arm' => $request->arm,
            'fat' => $request->fat,
            'staff_member' => implode(', ', $request->staff_member),
            'membership' => $request->membership,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        // $group = Group::find(implode(', ', $request->group));

        // foreach ($group as $groups) {

        //     $groups->increment('total_members');
        // }

        Mail::to($request->email)->send(new welcomemail("Welcome to our GYM", "You are a member of our GYM"));

        if ($member) {
            return response()->json([
                'status' => true,
                'message' => 'Successfully Added Member',
                'member' => $member
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $member = Member::find($id);
        $groupId = explode(',', $member->group);
        $staff_memberId = explode(', ', $member->staff_member);
        $groups = Group::all();
        $staff_members = Staff_Member::all();
        $memberships = Membership::all();
        return view('update-member', compact('member', 'groupId', 'staff_memberId', 'groups', 'staff_members', 'memberships'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return $request;
        $memberValidation = validator($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'gender' => 'required',
            'birth' => 'required',
            'group' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'chest' => 'required|numeric',
            'waist' => 'required|numeric',
            'thigh' => 'required|numeric',
            'arm' => 'required|numeric',
            'fat' => 'required|numeric',
            'staff_member' => 'required',
            'membership' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        if ($memberValidation->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed',
                'error' => $memberValidation->errors()->all()
            ], 401);
        }

        $member = Member::find($id);

        if ($request->hasFile('new_image')) {
            $path = public_path('uploads/');
            if ($member->image && file_exists($path . $member->image)) {
                unlink($path . $member->image);
            }

            $file = $request->file('new_image');
            $fileExtension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $fileExtension;
            $file->move(public_path('uploads'), $filename);
        } else if ($request->imageDropdown == 1) {
            $removeImg = $member->image = null;
            $filename = $removeImg;
        } else {
            $filename = $member->image;
        }

        $member->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'image' => $filename,
            'gender' => $request->gender,
            'birth' => $request->birth,
            'group' => implode(', ', $request->group),
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'phone' => $request->phone,
            'email' => $request->email,
            'weight' => $request->weight,
            'height' => $request->height,
            'chest' => $request->chest,
            'waist' => $request->waist,
            'thigh' => $request->thigh,
            'arm' => $request->arm,
            'fat' => $request->fat,
            'staff_member' => implode(', ', $request->staff_member),
            'membership' => $request->membership,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        if ($member) {
            return response()->json([
                'status' => true,
                'message' => 'Member Updated Successfully',
                'member' => $member
            ], 200);
        }
    }


    public function memberAttendance()
    {
        $groups = Group::all();
        return view('member-attendance', compact('groups'));
    }

    public function getmemberAttendance(Request $request)
    {
        if (!$request->has('group') || !is_array($request->group)) {
            return response()->json(['error' => 'Group parameter missing or invalid.'], 400);
        }

        $groupIds = $request->group;
        $attendanceDate = $request->date; // requested date
        $members = Member::where(function ($query) use ($groupIds) {
            foreach ($groupIds as $groupId) {
                $query->orWhere('group', 'LIKE', '%' . $groupId . '%');
            }
        })->get();

        // Loop through each member to check attendance status
        if ($members->count() != 0) {

            foreach ($members as $member) {
                $attendance = Attendance::where('member_id', $member->id)
                    ->where('attendance_date', $attendanceDate)
                    ->first();

                if ($attendance) {
                    $member->attendance_status = $attendance->status == 1 ? 'Present' : 'Absent';
                    $member->attendance_taken = 'taken';
                } else {
                    $member->attendance_status = 'Not Marked';
                    $member->attendance_taken = 'not taken';
                }
            }
        } else {
            return response()->json(['error' => 'No Member Found'], 200);
        }

        return response()->json(['members' => $members, 'groupIds' => $groupIds], 200);
    }


    public function updateAttendance(Request $request)
    {
        // return $request; 
        $date = $request->date;
        $memberId = $request->member_id;
        $groupId = $request->group_id;
        $status = $request->status;


        if ($date == null) {
            return response()->json(['message' => 'Please Select Date']);
        } else {

            $attendance = Attendance::updateOrCreate([
                'member_id' => $memberId,
                'group_id' => $groupId,
                'attendance_date' => $date
            ], [
                'status' => $status,
            ]);

            return response()->json(['message' => 'Attendance Marked Successfully']);
        }
    }


    // public function getmemberAttendancePDF(Request $request)
    // {
    //     if (!$request->has('group') || !is_array($request->group)) {
    //         return response()->json(['error' => 'Group parameter missing or invalid.'], 400);
    //     }

    //     $groupIds = $request->group;
    //     $attendanceDate = $request->date; // requested date
    //     $members = Member::where(function ($query) use ($groupIds) {
    //         foreach ($groupIds as $groupId) {
    //             $query->orWhere('group', 'LIKE', '%' . $groupId . '%');
    //         }
    //     })->get();

    //     // Loop through each member to check attendance status
    //     if ($members->count() != 0) {

    //         foreach ($members as $member) {
    //             $attendance = Attendance::where('member_id', $member->id)
    //                 ->where('attendance_date', $attendanceDate)
    //                 ->first();

    //             if ($attendance) {
    //                 $member->attendance_status = $attendance->status == 1 ? 'Present' : 'Absent';
    //                 $member->attendance_taken = 'taken';
    //             } else {
    //                 $member->attendance_status = 'Not Marked';
    //                 $member->attendance_taken = 'not taken';
    //             }
    //         }
    //     } else {
    //         return response()->json(['error' => 'No Member Found'], 200);
    //     }

    //     $pdf = Pdf::loadView('pdf.getmemberAttendancePDF', compact('members','attendanceDate'));

    //     $pdf->download('Members_Attendance.pdf');
    // }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
