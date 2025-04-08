<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Chat;
use App\Models\CustomPermission;
use App\Models\Event;
use App\Models\Member;
use App\Models\Overides\Role;
use App\Models\Partner;
use App\Models\Property;
use App\Models\Society;
use App\Models\SocietyUser;
use App\Models\Support;
use App\Models\University;
use App\Models\User;
use App\Models\Venue;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $members = Member::all();
        $properties = Property::all();
        $supports = Support::all();
        $chats = Chat::all();

        return view('admin.sections.dashboard',[
            'title' => 'Dashboard',
            'menu_active' => 'dashboard',
            'nav_sub_menu' => '',
            'members' => $members,
            'properties' => $properties,
            'supports' => $supports,
            'chats' => $chats,
        ]);
    }
}
