<?php

namespace App\Enums;

enum AssetStatus: String
{
    case Disponible = 'disponible';
    case Asignado = 'asignado';
    case EnMantenimiento = 'en_mantenimiento';
    case DeBaja = 'de_baja';
    case Perdido = 'perdido';
    case Robado = 'robado';
    case Otro = 'otro';
}
