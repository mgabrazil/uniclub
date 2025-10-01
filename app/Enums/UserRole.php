<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case Vendor = 'vendor';
    case Client = 'client';

    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Administrador',
            self::Vendor => 'Vendedor',
            self::Client => 'Cliente',
        };
    }
}
