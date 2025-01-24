<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        return view('admin.sections.support.index',[
            'title' => 'Support',
            'menu_active' => 'support',
            'nav_sub_menu' => '',
        ]);
    }

    public function create()
    {
        return view('admin.sections.support.create',[
            'title' => 'Support',
            'menu_active' => 'support',
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

        $support = new Support();
        $support->name = $request->name;
        $support->opening = $request->opening;
        $support->contact = $request->contact;
        $support->email = $request->email;
        $support->address = $request->address;
        $support->save();
        return redirect()->route('admin.support')->with('success' , 'Support Added Successfully');
    }
    

    public function edit(Support $support)
    {
        return view('admin.sections.support.edit',[
            'title' => 'Support',
            'menu_active' => 'support',
            'nav_sub_menu' => '',
            'support' => $support,
        ]);
    }

    public function update(Request $request ,Support $support)
    {
        $request->validate([
            'name' => 'required',
            'opening' => 'nullable',
            'contact' => 'required',   
            'email' => 'required',     
            'address' => 'required',   
            'society_logo' => 'nullable',   
        ], []);

        $support->name = $request->name;
        $support->opening = $request->opening;
        $support->contact = $request->contact;
        $support->email = $request->email;
        $support->address = $request->address;
        $support->save();

        return redirect()->route('admin.support')->with('success' , 'Support Updated Successfully');
    }

    public function show(Support $support)
    {
        $reports = Report::wherePartnerId($support->id)->get();
        return view('admin.sections.support.detail', [
            'title' => 'Support',
            'menu_active' => 'support',
            'nav_sub_menu' => '',
            'support' => $support,
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

    public function destroy(Support $support)
    {
        $support->delete();
        return redirect()->route('admin.support')->with('success', 'Support deleted successfully.');
    }
}
