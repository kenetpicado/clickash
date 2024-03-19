<?php

namespace App\Services;

class SettingService
{
    public function getTermsAndConditions(): object
    {
        return (object) [
            'type' => 'legal',
            'title' => 'Términos y condiciones',
            'content' => "Esta aplicación es un sistema de control de ingresos monetarios relacionados con sorteos. El Desarrollador no está involucrado en la organización ni ejecución de sorteos.\n\nLimitación de Responsabilidad: El Desarrollador no se hace responsable de la gestión de sorteos ni de la entrega de premios.\n\nPropiedad Intelectual: La Aplicación y sus derechos de propiedad intelectual pertenecen al Desarrollador.\n\nConfidencialidad: Ambas partes deben mantener la confidencialidad de la información compartida.\n\nDuración y Terminación: El acuerdo está en vigor hasta que cualquiera de las partes lo termine con aviso previo a 2 MESES DE ANTICIPACIÓN.\n\nAl utilizar esta aplicación, aceptas los términos y condiciones de este acuerdo.",
        ];
    }
}
