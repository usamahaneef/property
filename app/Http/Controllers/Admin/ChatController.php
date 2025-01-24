<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        return view('admin.sections.chat.index',[
            'title' => 'Chat',
            'menu_active' => 'chat',
            'nav_sub_menu' => '',
        ]);
    }

    public function create()
    {
        return view('admin.sections.chat.create',[
            'title' => 'Chat',
            'menu_active' => 'chat',
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

        $chat = new Chat();
        $chat->name = $request->name;
        $chat->opening = $request->opening;
        $chat->contact = $request->contact;
        $chat->email = $request->email;
        $chat->address = $request->address;
        $chat->save();
        return redirect()->route('admin.chat')->with('success' , 'Chat Added Successfully');
    }
    

    public function edit(Chat $chat)
    {
        return view('admin.sections.chat.edit',[
            'title' => 'Chat',
            'menu_active' => 'chat',
            'nav_sub_menu' => '',
            'chat' => $chat,
        ]);
    }

    public function update(Request $request ,Chat $chat)
    {
        $request->validate([
            'name' => 'required',
            'opening' => 'nullable',
            'contact' => 'required',   
            'email' => 'required',     
            'address' => 'required',   
            'society_logo' => 'nullable',   
        ], []);

        $chat->name = $request->name;
        $chat->opening = $request->opening;
        $chat->contact = $request->contact;
        $chat->email = $request->email;
        $chat->address = $request->address;
        $chat->save();

        return redirect()->route('admin.chat')->with('success' , 'Chat Updated Successfully');
    }

    public function show(Chat $chat)
    {
        $reports = Report::wherePartnerId($chat->id)->get();
        return view('admin.sections.chat.detail', [
            'title' => 'Chat',
            'menu_active' => 'chat',
            'nav_sub_menu' => '',
            'chat' => $chat,
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

    public function destroy(Chat $chat)
    {
        $chat->delete();
        return redirect()->route('admin.chat')->with('success', 'Chat deleted successfully.');
    }
}
