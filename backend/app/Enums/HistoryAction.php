<?php

namespace App\Enums;

enum HistoryAction: string
{
    case Creado = 'creado';
    case AsignadoEmpleado = 'asignado_empleado';
    case AsignadoUbicacion = 'asignado_ubicacion';
    case AsignadoEstado = 'asignado_estado';
    case Devuelto = 'devuelto';
}
