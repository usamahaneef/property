<?php

namespace App\Models\Overides;

use App\Models\Concerns\HasSchemalessProperties;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasSchemalessProperties;
    public static function getDefaultPermissons(): array
    {
        return [
            "dashboard" =>  [
                "dashboard.view",
                "dashboard.universities-view",
                "dashboard.societies-view",
                "dashboard.students-view",
                "dashboard.venues-view",
                "dashboard.events-view",
            ],
            "users" =>  [
                "users.view",
                "users.create",
                "users.edit",
                "users.delete",
                "users.permissions",
            ],
            "roles" => [
                "roles.view",
                "roles.create",
                "roles.assign",
            ],
            "settings" => [
                "settings.view",
                "settings.update",
            ],
            "passwords" => [
                "passwords.view",
                "passwords.update",
            ],
        ];
    }


    public static function getAdminPermissions(): array
    {
        return [
            "properties" =>  [
                "properties.bulk-view",
                "properties.view",
                "properties.detail",
                "properties.create",
                "properties.edit",
                "properties.delete",
            ],
            "members" =>  [
                "members.bulk-view",
                "members.view",
                "members.edit",
                "members.detail",
                "members.delete",
            ],
        ];
    }

}
