<?php

namespace App\Enums;

enum UserStatus: String
{
    case Activo = 'activo';
    case Inactivo = 'inactivo';
    case Pendiente = 'pendiente';
    case Suspendido = 'suspendido';
    case Eliminado = 'eliminado';
}
