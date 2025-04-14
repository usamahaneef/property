<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Property;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        return view('admin.sections.member.index',[
            'title' => 'Member',
            'menu_active' => 'member',
            'nav_sub_menu' => '',
        ]);
    }

    public function create()
    {
        return view('admin.sections.member.create',[
            'title' => 'Member',
            'menu_active' => 'member',
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

        $member = new Member();
        $member->name = $request->name;
        $member->opening = $request->opening;
        $member->contact = $request->contact;
        $member->email = $request->email;
        $member->address = $request->address;
        $member->save();
        return redirect()->route('admin.member')->with('success' , 'Member Added Successfully');
    }
    

    public function edit(Member $member)
    {
        return view('admin.sections.member.edit',[
            'title' => 'Member',
            'menu_active' => 'member',
            'nav_sub_menu' => '',
            'member' => $member,
        ]);
    }

    public function update(Request $request ,Member $member)
    {
        $request->validate([
            'name' => 'required',
            'opening' => 'nullable',
            'contact' => 'required',   
            'email' => 'required',     
            'address' => 'required',   
            'society_logo' => 'nullable',   
        ], []);

        $member->name = $request->name;
        $member->opening = $request->opening;
        $member->contact = $request->contact;
        $member->email = $request->email;
        $member->address = $request->address;
        $member->save();

        return redirect()->route('admin.member')->with('success' , 'Member Updated Successfully');
    }

    public function show(Member $member)
    {
        $properties = Property::whereMemberId($member->id)->get();
        return view('admin.sections.member.detail', [
            'title' => 'Member',
            'menu_active' => 'member',
            'nav_sub_menu' => '',
            'member' => $member,
            'properties' => $properties,
        ]);
    }


    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('admin.member')->with('success', 'Member deleted successfully.');
    }

    public function status(Request $request ,Member $member)
    {
        $member->status = $request->status;
        $member->save();
        return redirect()->route('admin.member')->with('success', 'Member Status Update successfully.');
    }
    
}
