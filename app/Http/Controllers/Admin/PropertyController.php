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
            'name' => 'required',
            'opening' => 'nullable',
            'contact' => 'required',   
            'email' => 'required',     
            'address' => 'required',   
            'society_logo' => 'nullable',   
        ], []);

        $property = new Property();
        $property->name = $request->name;
        $property->opening = $request->opening;
        $property->contact = $request->contact;
        $property->email = $request->email;
        $property->address = $request->address;
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
            'name' => 'required',
            'opening' => 'nullable',
            'contact' => 'required',   
            'email' => 'required',     
            'address' => 'required',   
            'society_logo' => 'nullable',   
        ], []);

        $property->name = $request->name;
        $property->opening = $request->opening;
        $property->contact = $request->contact;
        $property->email = $request->email;
        $property->address = $request->address;
        $property->save();

        return redirect()->route('admin.property')->with('success' , 'Property Updated Successfully');
    }

    public function show(Property $property)
    {
        $reports = Report::wherePartnerId($property->id)->get();
        return view('admin.sections.property.detail', [
            'title' => 'Property',
            'menu_active' => 'property',
            'nav_sub_menu' => '',
            'property' => $property,
            'reports' => $reports,
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
