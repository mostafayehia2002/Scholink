<?php

namespace App\Http\Controllers\Admin;

use App\Events\TestEvent;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin', 'auto_check_premission']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(Request $request)
    {
        $data = Admin::latest()->paginate(5);

        return view('Admin.admins.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('Admin.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|string',
                'email' => 'required|email|unique:admins,email',
                'password' => 'required|confirmed',
                'roles' => 'required'
            ]);

            $input = $request->all();
            $input['password'] = Hash::make($input['password']);

            $admin = Admin::create($input);
            $admin->assignRole($request->input('roles'));

            return redirect()->route('admin.admins.index')
                ->with('success',  __('admins.s_add_admin'));
        } catch (Exception $e) {
            return redirect()->back()->withInput($request->only('email', 'name'))->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $admin = Admin::find($id);
        // return view('Dashboard.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        $roles = Role::pluck('name', 'name')->all();
        $adminRole = $admin->roles->pluck('name', 'name')->all();

        return view('Admin.admins.edit', compact('admin', 'roles', 'adminRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:admins,email,' . $id,
            'password' => 'nullable|confirmed',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $admin = Admin::find($id);
        $admin->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $admin->assignRole($request->input('roles'));
        return redirect()->route('admin.admins.index')
            ->with('success', __('admins.s_update_admin'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Admin::findOrFail($id)->delete();
        return redirect()->route('admin.admins.index')
            ->with('success',  __('admins.s_delete_admin'));
    }
}

