<?php
  include "./bd/conexion.php";
      $id_cli = $_POST["id_cli"];
      $id_lib = $_POST["id"];
      $coleccion = $_POST["coleccion"];
      $estado = $_POST["estado"];
      $busqueda = 'EXITOSA';
      $reglas = array();
      //============================================================================== Validacion Usuario
      $sql = " SELECT count(usuario.id) AS cant_usu FROM usuario
        WHERE usuario.id = $id_cli";
      $resultado = $conexion->query($sql);
      $row = $resultado->fetch_array();
      $cant_usu = $row["cant_usu"];

      if($cant_usu > 0){
        $id_usu = 'REGISTRADO';
        array_push($reglas, 'R6');
      }else{
        $id_usu = 'NO_REGISTRADO';
        array_push($reglas, 'R10');
      }

      //==============================================================================Regla1 premisa1
      $sql = "SELECT valor FROM obj_regla
        JOIN regla ON obj_regla.regla_id = regla.id
        JOIN objeto ON obj_regla.objeto_id=objeto.id AND objeto.nombre='BUSQUEDA'
        JOIN obj_tipo ON obj_tipo.des='PREMISA'
        WHERE regla.id=1";
      $resultado = $conexion->query($sql);
      $row = $resultado->fetch_array();
      $r1p1_bus_val = strtoupper($row["valor"]);

      //==============================================================================Regla1 premisa2
      $sql = "SELECT valor FROM obj_regla
        JOIN regla ON obj_regla.regla_id = regla.id
        JOIN objeto ON obj_regla.objeto_id=objeto.id AND objeto.nombre='LIBRO'
        JOIN obj_tipo ON obj_tipo.des='PREMISA'
        WHERE regla.id=1";
      $resultado = $conexion->query($sql);
      $row = $resultado->fetch_array();
      $r1p2_lib_val = strtoupper($row["valor"]);

      //==============================================================================Regla1 premisa2 :: regla5 premisa1
      $sql = "SELECT valor FROM obj_regla
        JOIN regla ON obj_regla.regla_id = regla.id
        JOIN objeto ON obj_regla.objeto_id = objeto.id AND objeto.nombre = 'CODIGO'
        JOIN obj_tipo ON obj_tipo.des = 'PREMISA'
        WHERE regla.id = 5";
      $resultado = $conexion->query($sql);
      $row = $resultado->fetch_array();
      $r5p1_cod_val = strtoupper($row["valor"]);

      $sql = " SELECT count(libro.id) AS cantidad FROM libro
        WHERE libro.id = $id_lib";
      $resultado = $conexion->query($sql);
      $row = $resultado->fetch_array();
      $cantidad = $row["cantidad"];

      if($cantidad > 0){
        $codigo = 'VALIDO';
        array_push($reglas, 'R5');
      }else{
        $codigo = 'NO_VALIDO';
        array_push($reglas, 'R7');
      }
      //==============================================================================Regla1 premisa2 :: regla5 premisa2
      $sql = "SELECT valor FROM obj_regla
        JOIN regla ON obj_regla.regla_id=regla.id
        JOIN objeto ON obj_regla.objeto_id=objeto.id AND objeto.nombre='ESTADO'
        JOIN obj_tipo ON obj_tipo.des='PREMISA'
        WHERE regla.id=5";
      $resultado = $conexion->query($sql);
      $row = $resultado->fetch_array();
      $r5p2_est_val = strtoupper($row["valor"]);

      //==============================================================================Regla1 premisa2 :: regla5 premisa3
      $sql = "SELECT valor FROM obj_regla
        JOIN regla ON obj_regla.regla_id=regla.id
        JOIN objeto ON obj_regla.objeto_id=objeto.id AND objeto.nombre='CONSULTA'
        JOIN obj_tipo ON obj_tipo.des='PREMISA'
        WHERE regla.id=5";
      $resultado = $conexion->query($sql);
      $row = $resultado->fetch_array();
      $r5p3_con_val = strtoupper($row["valor"]);

      if((strcmp($coleccion, 'GENERAL') === 0) || (strcmp($coleccion, 'RESERVA') === 0)){
        $consulta = 'EXTERNA';
      }else{
        $consulta = 'EN_SALA';
        array_push($reglas, 'R9');
      }

      //==============================================================================regla1 premisa2 :: validacion
      if ((strcmp($codigo, $r5p1_cod_val) === 0) && (strcmp($estado, $r5p2_est_val) === 0) && (strcmp($consulta, $r5p3_con_val) === 0)){
        $libro = 'APTO';
      }else{
        $libro = 'NO_APTO';
        array_push($reglas, 'R3');
      }

      //==============================================================================Regla1 premisa3
      $sql = "SELECT valor FROM obj_regla
        JOIN regla ON obj_regla.regla_id = regla.id
        JOIN objeto ON obj_regla.objeto_id=objeto.id AND objeto.nombre='USUARIO'
        JOIN obj_tipo ON obj_tipo.des='PREMISA'
        WHERE regla.id=1";
      $resultado = $conexion->query($sql);
      $row = $resultado->fetch_array();
      $r1p3_usu_val = strtoupper($row["valor"]);

      //==============================================================================Regla1 premisa3 :: regla6 premisa1
      $sql = "SELECT valor FROM obj_regla
        JOIN regla ON obj_regla.regla_id = regla.id
        JOIN objeto ON obj_regla.objeto_id = objeto.id AND objeto.nombre = 'ID'
        JOIN obj_tipo ON obj_tipo.des = 'PREMISA'
        WHERE regla.id = 6";
      $resultado = $conexion->query($sql);
      $row = $resultado->fetch_array();
      $r6p1_cod_val = strtoupper($row["valor"]);

      //==============================================================================Regla1 premisa3 :: regla6 premisa2
      $sql = "SELECT valor FROM obj_regla
        JOIN regla ON obj_regla.regla_id = regla.id
        JOIN objeto ON obj_regla.objeto_id = objeto.id AND objeto.nombre = 'PRES_PEN'
        JOIN obj_tipo ON obj_tipo.des = 'PREMISA'
        WHERE regla.id = 6";
      $resultado = $conexion->query($sql);
      $row = $resultado->fetch_array();
      $r6p2_pp_val = strtoupper($row["valor"]);

      $sql = "SELECT COUNT(prestamo.usuario_id) AS CPP FROM prestamo
        JOIN usuario ON prestamo.usuario_id=usuario.id
        JOIN pres_estado ON prestamo.pres_estado_id=pres_estado.id
        WHERE pres_estado.estado='PENDIENTE' AND usuario_id = $id_cli
        GROUP BY (usuario.id)";
      $resultado = $conexion->query($sql);
      $row = $resultado->fetch_array();
      $cant_pres = $row["CPP"];

      if($cant_pres < 3){
        $prest_pend = 'NO_EXCEDE';
      }else{
        $prest_pend = 'EXCEDE';
        array_push($reglas, 'R11');
      }
      //==============================================================================Regla1 premisa3 :: regla6 premisa3
      $sql = "SELECT valor FROM obj_regla
        JOIN regla ON obj_regla.regla_id = regla.id
        JOIN objeto ON obj_regla.objeto_id = objeto.id AND objeto.nombre = 'SANCION'
        JOIN obj_tipo ON obj_tipo.des = 'PREMISA'
        WHERE regla.id = 6";
      $resultado = $conexion->query($sql);
      $row = $resultado->fetch_array();
      $r6p3_san_val = strtoupper($row["valor"]);

      $sql = "SELECT COUNT(sancion.id) AS SP FROM sancion
      JOIN prestamo ON sancion.prestamo_id=prestamo.id
      JOIN usuario ON prestamo.usuario_id=usuario.id
      JOIN san_estado ON san_estado.id=sancion.san_estado_id
      WHERE san_estado.estado <> 'CUMPLIDO' AND lev_fecha > CURDATE() AND usuario_id = $id_cli
      GROUP BY (prestamo.usuario_id)";
      $resultado = $conexion->query($sql);
      $row = $resultado->fetch_array();
      $can_san = $row["SP"];

      if($can_san > 0){
        $sancion = 'VIGENTE';
        array_push($reglas, 'R11');
      }else{
        $sancion = 'NO_VIGENTE';
      }

      //==============================================================================regla1 premisa3 :: validacion
      if ((strcmp($id_usu, $r6p1_cod_val) === 0) && (strcmp($prest_pend, $r6p2_pp_val) === 0) && (strcmp($sancion, $r6p3_san_val) === 0)){
        $usuario = 'AUTORIZADO';
      }else{
        $usuario = 'NO_AUTORIZADO';
        array_push($reglas, 'R4');
      }

      //==============================================================================regla1  validacion
      if ((strcmp($busqueda, $r1p1_bus_val) === 0) && (strcmp($libro, $r1p2_lib_val) === 0) && (strcmp($usuario, $r1p3_usu_val) === 0)){
        $prestamo = 'APROBADO';
        array_push($reglas, 'R1');
        echo('
        <script>
          Swal.fire({
            title: "Prestamo Aprobado",
            text: "Su solicitud cumple con todas las condiciones",
            icon: "success",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Información"
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                "Prestamo Aprobado!",
                "Se cumplieron las siguientes reglas<br><br>');
                foreach($reglas as $reg){
                  switch($reg){
                    case 'R1':
                      echo('<h6 align=left>R1: La busqueda del libro fue exitosa</h6>');
                      break;
                    case 'R2':
                      echo('<h6 align=left>R2: La busqueda del libro no fue exitosa</h6>');
                      break;
                    case 'R3':
                      echo('<h6 align=left>R3: El libro no fue Apto para el prestamo</h6>');
                      break;
                    case 'R4':
                      echo('<h6 align=left>R4: El usuario no fue autorizado para el prestamo</h6>');
                      break;
                    case 'R5':
                      echo('<h6 align=left>R5: El libro fue Apto para el prestamo</h6>');
                      break;
                    case 'R6':
                      echo('<h6 align=left>R6: El usuario fue autorizado para el prestamo</h6>');
                      break;
                    case 'R7':
                      echo('<h6 align=left>R7: El codigo del libro no es valido</h6>');
                      break;
                    case 'R8':
                      echo('<h6 align=left>R8: El estado del libro no esta disponible</h6>');
                      break;
                    case 'R9':
                      echo('<h6 align=left>R9: El estado de la consulta del libro es en sala</h6>');
                      break;
                    case 'R10':
                      echo('<h6 align=left>R10: El usuario no esta registrado</h6>');
                      break;
                    case 'R11':
                      echo('<h6 align=left>R11: El usuario excede el numero de prestamos posibles (mayor a 3 libros)</h6>');
                      break;
                    case 'R12':
                      echo('<h6 align=left>R12: El usuario tiene sanciones vigentes</h6>');
                      break;
                  }
                }
                echo('",
                "success"
              )
            }
          })
        </script>
      ');
      }else{
        $prestamo = 'NO_APROBADO';
        echo('
        <script>
          Swal.fire({
            title: "Prestamo No Aprobado",
            text: "Su solicitud no cumple con todas las condiciones",
            icon: "error",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Información"
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                "Prestamo No Aprovado!",
                "No se cumplieron las siguientes reglas<br><br>');
                foreach($reglas as $reg){
                  switch($reg){
                    case 'R2':
                      echo('<h6 align=left>R2: La busqueda del libro no fue exitosa</h6>');
                      break;
                    case 'R3':
                      echo('<h6 align=left>R3: El libro no fue Apto para el prestamo</h6>');
                      break;
                    case 'R4':
                      echo('<h6 align=left>R4: El usuario no fue autorizado para el prestamo</h6>');
                      break;
                    case 'R7':
                      echo('<h6 align=left>R7: El codigo del libro no es valido</h6>');
                      break;
                    case 'R8':
                      echo('<h6 align=left>R8: El estado del libro no esta disponible</h6>');
                      break;
                    case 'R9':
                      echo('<h6 align=left>R9: El estado de la consulta del libro es en sala</h6>');
                      break;
                    case 'R10':
                      echo('<h6 align=left>R10: El usuario no esta registrado</h6>');
                      break;
                    case 'R11':
                      echo('<h6 align=left>R11: El usuario excede el numero de prestamos posibles (mayor a 3 libros)</h6>');
                      break;
                    case 'R12':
                      echo('<h6 align=left>R12: El usuario tiene sanciones vigentes</h6>');
                      break;
                  }
                }
                echo('",
                "warning"
              )
            }
          })
        </script>
      ');
      }

?>
