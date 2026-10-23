<?php

namespace App\Enums;

enum UserStatus: string
{
    case Activo = 'activo';
    case Inactivo = 'inactivo';
    case Pendiente = 'pendiente';
    case Suspendido = 'suspendido';
    case Eliminado = 'eliminado';
}
