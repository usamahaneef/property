<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
            'unit_no' => 'required',
            'room_sq' => 'required',
            'property_sq' => 'required',
            'bedroom' => 'required',
            'bathroom' => 'required',
            'cat' => 'required',
            'dog' => 'required',
            'amount' => 'required',
            'security' => 'required',
            'available_day' => 'required',
            'lease' => 'nullable',     
            'detail' => 'nullable',     
            'place' => 'required',   
            'longitude' => 'nullable',   
            'latitude' => 'nullable',     
            'cover_img' => 'nullable',    
        ], []);

        $property = new Property();
        $property->title = $request->title;
        $property->date_time = $request->date_time;
        $property->type = $request->type;
        $property->unit_no = $request->unit_no;
        $property->room_sq = $request->room_sq;
        $property->property_sq = $request->property_sq;
        $property->bedroom = $request->bedroom;
        $property->bathroom = $request->bathroom;
        $property->cat = $request->cat;
        $property->dog = $request->dog;
        $property->amount = $request->amount;
        $property->security = $request->security;
        $property->available_day = $request->available_day;
        $property->lease = $request->lease;
        $property->detail = $request->detail;
        $property->place = $request->place;
        $property->longitude = $request->longitude;
        $property->latitude = $request->latitude;

        if ($request->cover_img) {
            $property->addMedia($request->cover_img)->toMediaCollection('cover_img');
        }

        if($request->images) {
            foreach($request->images as $image) {
                $property->addMedia($image)->toMediaCollection('property_images');
            }
        }
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

    public function gallery(Property $property , Media $image)
    {
        $image->delete();
        return redirect()->back()->with('success', 'Property gallery removed successfully');
    }

    public function update(Request $request ,Property $property)
    {
        $request->validate([
            'title' => 'required',
            'date_time' => 'nullable',
            'type' => 'required',  
            'unit_no' => 'required',
            'room_sq' => 'required',
            'property_sq' => 'required',
            'bedroom' => 'required',
            'bathroom' => 'required',
            'cat' => 'required',
            'dog' => 'required',
            'amount' => 'required',
            'security' => 'required',
            'available_day' => 'required',
            'lease' => 'nullable',     
            'detail' => 'nullable',     
            'place' => 'required',   
            'longitude' => 'nullable',   
            'latitude' => 'nullable',     
            'cover_img' => 'nullable',    
        ], []);

        $property->title = $request->title;
        $property->date_time = $request->date_time;
        $property->type = $request->type;
        $property->unit_no = $request->unit_no;
        $property->room_sq = $request->room_sq;
        $property->property_sq = $request->property_sq;
        $property->bedroom = $request->bedroom;
        $property->bathroom = $request->bathroom;
        $property->cat = $request->cat;
        $property->dog = $request->dog;
        $property->amount = $request->amount;
        $property->security = $request->security;
        $property->available_day = $request->available_day;
        $property->lease = $request->lease;
        $property->detail = $request->detail;
        $property->place = $request->place;
        $property->longitude = $request->longitude;
        $property->latitude = $request->latitude;

        if ($request->cover_img) {
            $property->addMedia($request->cover_img)->toMediaCollection('cover_img');
        }

        if($request->images) {
            foreach($request->images as $image) {
                $property->addMedia($image)->toMediaCollection('property_images');
            }
        }
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
