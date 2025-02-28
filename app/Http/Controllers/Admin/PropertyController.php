<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        return view('admin.sections.property.index',[
            'title' => 'Property',
            'menu_active' => 'property',
            'nav_sub_menu' => '',
        ]);
    }

    public function create()
    {
        return view('admin.sections.property.create',[
            'title' => 'Property',
            'menu_active' => 'property',
            'nav_sub_menu' => '',
        ]);
    }

    public function store(Request $request)
    {   
        $request->validate([
            'title' => 'required',
            'date_time' => 'nullable',
            'type' => 'required',   
            'detail' => 'nullable',     
            'place' => 'required',   
            'longitude' => 'nullable',   
            'latitude' => 'nullable',   
        ], []);

        $property = new Property();
        $property->title = $request->title;
        $property->date_time = $request->date_time;
        $property->type = $request->type;
        $property->detail = $request->detail;
        $property->place = $request->place;
        $property->longitude = $request->longitude;
        $property->latitude = $request->latitude;
        $property->save();
        return redirect()->route('admin.property')->with('success' , 'Property Added Successfully');
    }
    

    public function edit(Property $property)
    {
        return view('admin.sections.property.edit',[
            'title' => 'Property',
            'menu_active' => 'property',
            'nav_sub_menu' => '',
            'property' => $property,
        ]);
    }

    public function update(Request $request ,Property $property)
    {
        $request->validate([
            'title' => 'required',
            'date_time' => 'nullable',
            'type' => 'required',   
            'detail' => 'nullable',     
            'place' => 'required',   
            'longitude' => 'nullable',   
            'latitude' => 'nullable',   
        ], []);

        $property->title = $request->title;
        $property->date_time = $request->date_time;
        $property->type = $request->type;
        $property->detail = $request->detail;
        $property->place = $request->place;
        $property->longitude = $request->longitude;
        $property->latitude = $request->latitude;
        $property->save();

        return redirect()->route('admin.property')->with('success' , 'Property Updated Successfully');
    }

    public function show(Property $property)
    {
        return view('admin.sections.property.detail', [
            'title' => 'Property',
            'menu_active' => 'property',
            'nav_sub_menu' => '',
            'property' => $property,
        ]);
    }

    public function print(Staff $staff)
    {
        return view('admin.sections.staff.print', [
            'title' => 'Staff',
            'menu_active' => 'staff',
            'nav_sub_menu' => '',
            'staff' => $staff,
        ]);
            
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('admin.property')->with('success', 'Property deleted successfully.');
    }
}
