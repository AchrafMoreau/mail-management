<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Setting;
use App\Models\Region;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $regions = Region::all();
        $setting = Setting::find(Auth::id());
        return view("setting.index", ["settings" => $setting, "regions" => $regions]);

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        //
        $setting = Setting::where("user_id", $id)->first();

        // dd($request);
        $setting->name = $request->name;
        $setting->region_id = $request->region;
        $request->input("data-bs-theme") && $setting->theme = $request->input("data-bs-theme");
        $request->input("data-layout-style") && $setting->data_layout_style = $request->input("data-layout-style");
        $request->input("data-sidebar") && $setting->data_sidebar = $request->input("data-sidebar");
        $request->input("data-layout-position") && $setting->data_layout_position = $request->input("data-layout-position");
        $request->input("data-topbar") && $setting->data_topbar = $request->input("data-topbar");
        $setting->save();

        $notification = array(
            'message' => 'Setting Updated successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
