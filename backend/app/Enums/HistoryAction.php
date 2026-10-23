<?php

namespace App\Enums;

enum HistoryAction: String
{
    case Creado = 'creado';
    case AsignadoEmpleado = 'asignado_empleado';
    case AsignadoArea = 'asignado_area';
    case AsignadoUbicacion = 'asignado_ubicacion';
    case AsignadoResponsable = 'asignado_responsable';
    case AsignadoEstado = 'asignado_estado';
    case AsignadoFecha = 'asignado_fecha';
    case AsignadoHora = 'asignado_hora';
    case AsignadoUsuario = 'asignado_usuario';
    case AsignadoMotivo = 'asignado_motivo';
}
