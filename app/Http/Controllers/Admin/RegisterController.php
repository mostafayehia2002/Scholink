<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\MessageRequest;
use App\Mail\StatusRequest;
use App\Models\Classe;
use App\Models\Level;
use App\Models\ParentStudent;
use App\Models\Register;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $request->validate(['status' => 'nullable|in:accept,pending,reject,confirmed']);
            $data = Register::latest()->where(
                function ($query) use ($request) {
                    if ($request->has('status')) {
                        $query->where('status', $request->status);
                    }
                }
            )->paginate(20);
            return view('Admin.registers.index', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'id' => "required|exists:register,id",
                'message' => 'required|string',
            ]);
            $data = Register::find($request->id);
            Mail::to($data->parent_email)->send(new MessageRequest($request->message, $data));
            return redirect()->back()->with('success', __('register.s_send_message'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:accept,reject',
            ]);
            $data = Register::find($id);
            //If Request Rejected
            if ($request->status == 'reject') {
                Mail::to($data->parent_email)->send(new StatusRequest($data, $request->status));
                $data->update(['status' => $request->status]);
                return redirect()->back()->with('success', 'Success Reject Request');
            } elseif ($request->status == 'accept') {
                DB::beginTransaction();
                $data->update(['status' => $request->status]);
                $parent = '';
                $checkParent = ParentStudent::where('national_id', $data->parent_national_id)->first();
                if (!$checkParent) {
                    $parent = ParentStudent::create([
                        'name' => ['ar' => $data->getTranslation('parent_name', 'ar'), 'en' => $data->getTranslation('parent_name', 'en'),],
                        'mobile' => $data->parent_mobile,
                        'email' => $data->parent_email,
                        'national_id' => $data->parent_national_id,
                        'address' => $data->parent_address,
                        'job' => $data->parent_job,
                        'gender' => $data->parent_gender,
                        'date_birth' => $data->parent_data_birth,
                        'password' => bcrypt($data->parent_national_id),
                    ]);
                } else {
                    $parent = ParentStudent::where('national_id', $data->parent_national_id)->first();
                }

                $setting = Setting::first();

                $level = Level::where('id', $data->child_level)->with(['classes' => function ($query)use($setting) {
                    $query->where('available_seats', '<=', $setting->number_seats)->where('available_seats', '!=', 0)->first();
                }])->first();

                if ($level) {
                    $student = Student::create([
                        'parent_id' => $parent->id,
                        'name' => ['ar' => $data->getTranslation('child_name', 'ar'), 'en' => $data->getTranslation('child_name', 'en'),],
                        'email' => substr($data->getTranslation('child_name', 'en'), 0, 10) . rand(1111, 9999) . "@gmail.com",
                        'gender' => $data->child_gender,
                        'class_id' => $level->classes[0]->id,
                        'date_birth' => $data->child_date_birth,
                        'password' => bcrypt('123456'),
                    ]);
                    $level->update(['available_seats' => $level->available_seats - 1]);
                } else {
                    DB::rollback();
                    return redirect()->back()->with('error', 'Class Is Completed');
                }

            }
            $data->update(['status' => $request->status]);
            $data->delete();
            DB::commit();
            Mail::to($data->parent_email)->send(new StatusRequest($data, $request->status, [
                'parent' => $parent,
                'student' => $student,
                'class' => $level
            ]));
            return redirect()->back()->with('success', __('register.update_request'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Register::find($id);
            unlink(public_path($data->parent_personal_identification));
            unlink(public_path($data->child_birth_certificate));
            $data->forceDelete();
            return redirect()->back()->with('success', __('register.delete_request'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
