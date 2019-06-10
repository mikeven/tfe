<?php 
	/*
     * TFE Life Planner - Funciones sobre Actividades.
     * 
     */
    /* --------------------------------------------------------- */
    function etiqAct( $t ){
        // Devuelve la etiqueta del tipo de actvidad según parámetro t
        $tipo_actividad = array(
          'g' => "Gestión",
          'e' => "Escritorio",
          'l' => "Llamada"
        );

        return $tipo_actividad[$t];
    }
    /* --------------------------------------------------------- */
    function iconoActividad( $t ){
        // Devuelve el ícono del tipo de actvidad según parámetro t
        $icono_actividad = array(
          'g' => "<i class='fa fa-exchange'></i>",
          'e' => "<i class='fa fa-desktop'></i>",
          'l' => "<i class='fa fa-mobile'></i>"
        );

        return $icono_actividad[$t];
    }
    /* --------------------------------------------------------- */
?>