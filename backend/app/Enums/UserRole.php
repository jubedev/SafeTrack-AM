<?php

namespace App\Enums;

enum UserRole: String
{
    case SuperAdmin = 'super_admin';
    case Admin = 'admin';
    case Tecnico = 'tecnico';
    case Empleado = 'empleado';
}
