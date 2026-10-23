<?php

namespace App\Enums;

enum AssetStatus: string
{
    case Disponible = 'disponible';
    case Asignado = 'asignado';
    case EnMantenimiento = 'en_mantenimiento';
    case DeBaja = 'de_baja';
    case Perdido = 'perdido';
    case Robado = 'robado';
}
