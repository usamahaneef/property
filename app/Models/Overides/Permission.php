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
                "dashboard.members-view",
                "dashboard.properties-view",
                "dashboard.support-view",
                "dashboard.chat-view",
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
                "properties.view",
                "properties.detail",
                "properties.create",
                "properties.edit",
                "properties.delete",
            ],
            "members" =>  [
                "members.view",
                "members.status",
                "members.detail",
                "members.delete",
            ],
            "support" =>  [
                "support.view",
                "support.detail",
                "support.delete",
            ],
            "chats" =>  [
                "chats.view",
                "chats.detail",
                "chats.delete",
            ],
        ];
    }

}
