<?php 
  /*
  * TFE Life Planner - Funciones sobre sujetos-objetos.
  * 
  */
  /* --------------------------------------------------------- */
  function obtenerSOAntSig( $lista, $ids, $ido ){
  // Devuelve los registros anterior y siguiente a un sujeto-objeto dado
    $i = 0;
    $reg["ant"] = $reg["sig"] = NULL;

    foreach ( $lista  as $so ) {

      if( ( $so["idsujeto"] == $ids ) && ( $so["idobjeto"] == $ido ) ){

        if( isset( $lista[$i-1] ) ) 
          $reg["ant"] = $lista[$i-1];
        if( isset( $lista[$i+1] ) ) 
          $reg["sig"] = $lista[$i+1];
      
      }
      $i++;

    }

    return $reg;
  }
  /* --------------------------------------------------------- */
?>