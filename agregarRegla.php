<?php
  include "./templates/nav.php";
    echo('<div class="container">');

      $id_cli = $_POST["id_cli"];
      $id_lib = $_GET["id"];
      $coleccion = $_GET["coleccion"];
      $estado = $_GET["estado"];
      $busqueda = 'EXITOSA';
      echo('Id Cliente: '.$id_cli.'<br>');
      echo('Id libro: '.$id.'<br>');
      echo('Estado libro: '.$estado.'<br>');
      echo('Coleccion libro: '.$coleccion.'<br>');

      //============================================================================== Validacion Usuario
      $sql = " SELECT count(usuario.id) AS cant_usu FROM usuario
        WHERE usuario.id = $id_cli";
      $resultado = $conexion->query($sql);
      $row = $resultado->fetch_array();
      $cant_usu = $row["cant_usu"];
      echo('Cantidad: '.$cant_usu.'<br>');

      if($cant_usu > 0){
        $id_usu = 'REGISTRADO';
      }else{
        $id_usu = 'NO_REGISTRADO';
        echo('
          <script>
            swal({
              title: "Error",
              text: "Usuario ingresado no está registrado",
              icon: "error",
              button: "Aceptar",
            });
          </script>
        ');
        exit();
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
      echo('Regla 1 Premisa 1: '.$r1p1_bus_val.'<br>');

      //==============================================================================Regla1 premisa2
      $sql = "SELECT valor FROM obj_regla
        JOIN regla ON obj_regla.regla_id = regla.id
        JOIN objeto ON obj_regla.objeto_id=objeto.id AND objeto.nombre='LIBRO'
        JOIN obj_tipo ON obj_tipo.des='PREMISA'
        WHERE regla.id=1";
      $resultado = $conexion->query($sql);
      $row = $resultado->fetch_array();
      $r1p2_lib_val = strtoupper($row["valor"]);
      echo('Regla 1 Premisa 2: '.$r1p2_lib_val.'<br>');

      //==============================================================================Regla1 premisa2 :: regla5 premisa1
      $sql = "SELECT valor FROM obj_regla
        JOIN regla ON obj_regla.regla_id = regla.id
        JOIN objeto ON obj_regla.objeto_id = objeto.id AND objeto.nombre = 'CODIGO'
        JOIN obj_tipo ON obj_tipo.des = 'PREMISA'
        WHERE regla.id = 5";
      $resultado = $conexion->query($sql);
      $row = $resultado->fetch_array();
      $r5p1_cod_val = strtoupper($row["valor"]);
      echo('Regla 5 Premisa 1: '.$r5p1_cod_val.'<br>');

      $sql = " SELECT count(libro.id) AS cantidad FROM libro
        WHERE libro.id = $id_lib";
      $resultado = $conexion->query($sql);
      $row = $resultado->fetch_array();
      $cantidad = $row["cantidad"];
      echo('Cantidad: '.$cantidad.'<br>');

      if($cantidad > 0){
        $codigo = 'VALIDO';
      }else{
        $codigo = 'NO_VALIDO';
        echo('
          <script>
            swal({
              title: "Libro no apto para préstamo",
              text: "El Código del libro no es válido",
              icon: "error",
              button: "Aceptar",
            });
          </script>
        ');
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
      echo('Regla 5 Premisa 2: '.$r5p2_est_val.'<br>');

      //==============================================================================Regla1 premisa2 :: regla5 premisa3
      $sql = "SELECT valor FROM obj_regla
        JOIN regla ON obj_regla.regla_id=regla.id
        JOIN objeto ON obj_regla.objeto_id=objeto.id AND objeto.nombre='CONSULTA'
        JOIN obj_tipo ON obj_tipo.des='PREMISA'
        WHERE regla.id=5";
      $resultado = $conexion->query($sql);
      $row = $resultado->fetch_array();
      $r5p3_con_val = strtoupper($row["valor"]);
      echo('Regla 5 Premisa 3: '.$r5p3_con_val.'<br>');

      if((strcmp($coleccion, 'GENERAL') === 0) || (strcmp($coleccion, 'RESERVA') === 0)){
        $consulta = 'EXTERNA';
      }else{
        $consulta = 'EN_SALA';
        echo('
          <script>
            swal({
              title: "Libro no apto para préstamo",
              text: "El libro no esta disponible para consulta Externa",
              icon: "error",
              button: "Aceptar",
            });
          </script>
        ');
      }
      echo('Consulta: '.$consulta.'<br>');


      //==============================================================================regla1 premisa2 :: validacion
      if ((strcmp($codigo, $r5p1_cod_val) === 0) && (strcmp($estado, $r5p2_est_val) === 0) && (strcmp($consulta, $r5p3_con_val) === 0)){
        $libro = 'APTO';
      }else{
        $libro = 'NO_APTO';
        echo('
          <script>
          swal({
            title: "Libro No Apto",
            text: "El libro no cumple las condiciones para el prestamo",
            icon: "error",
            buttons: true,
            dangerMode: true,
          })
          .then((value) => {
            if (value) {
              swal("Your imaginary file is safe!");
            } else {
              swal("Your imaginary file is safe!");
            }
          });
          </script>
        ');
      }
      echo('libro: '.$libro.'<br><br>');

      //==============================================================================Regla1 premisa3
      $sql = "SELECT valor FROM obj_regla
        JOIN regla ON obj_regla.regla_id = regla.id
        JOIN objeto ON obj_regla.objeto_id=objeto.id AND objeto.nombre='USUARIO'
        JOIN obj_tipo ON obj_tipo.des='PREMISA'
        WHERE regla.id=1";
      $resultado = $conexion->query($sql);
      $row = $resultado->fetch_array();
      $r1p3_usu_val = strtoupper($row["valor"]);
      echo('Regla 1 Premisa 3: '.$r1p3_usu_val.'<br>');

      //==============================================================================Regla1 premisa3 :: regla6 premisa1
      $sql = "SELECT valor FROM obj_regla
        JOIN regla ON obj_regla.regla_id = regla.id
        JOIN objeto ON obj_regla.objeto_id = objeto.id AND objeto.nombre = 'ID'
        JOIN obj_tipo ON obj_tipo.des = 'PREMISA'
        WHERE regla.id = 6";
      $resultado = $conexion->query($sql);
      $row = $resultado->fetch_array();
      $r6p1_cod_val = strtoupper($row["valor"]);
      echo('Regla 6 Premisa 1: '.$r6p1_cod_val.'<br>');

      //==============================================================================Regla1 premisa3 :: regla6 premisa2
      $sql = "SELECT valor FROM obj_regla
        JOIN regla ON obj_regla.regla_id = regla.id
        JOIN objeto ON obj_regla.objeto_id = objeto.id AND objeto.nombre = 'PRES_PEN'
        JOIN obj_tipo ON obj_tipo.des = 'PREMISA'
        WHERE regla.id = 6";
      $resultado = $conexion->query($sql);
      $row = $resultado->fetch_array();
      $r6p2_pp_val = strtoupper($row["valor"]);
      echo('Regla 6 Premisa 2: '.$r6p2_pp_val.'<br>');

      $sql = "SELECT COUNT(prestamo.usuario_id) AS CPP FROM prestamo
        JOIN usuario ON prestamo.usuario_id=usuario.id
        JOIN pres_estado ON prestamo.pres_estado_id=pres_estado.id
        WHERE pres_estado.estado='PENDIENTE' AND usuario_id = $id_cli
        GROUP BY (usuario.id)";
      $resultado = $conexion->query($sql);
      $row = $resultado->fetch_array();
      $cant_pres = $row["CPP"];
      echo('Cantidad: '.$cant_pres.'<br>');

      if($cant_pres < 3){
        $prest_pend = 'NO_EXCEDE';
      }else{
        $prest_pend = 'EXCEDE';
      }
      echo('PREST_PEND: '.$prest_pend.'<br><br>');
      //==============================================================================Regla1 premisa3 :: regla6 premisa3
      $sql = "SELECT valor FROM obj_regla
        JOIN regla ON obj_regla.regla_id = regla.id
        JOIN objeto ON obj_regla.objeto_id = objeto.id AND objeto.nombre = 'SANCION'
        JOIN obj_tipo ON obj_tipo.des = 'PREMISA'
        WHERE regla.id = 6";
      $resultado = $conexion->query($sql);
      $row = $resultado->fetch_array();
      $r6p3_san_val = strtoupper($row["valor"]);
      echo('Regla 6 Premisa 3: '.$r6p3_san_val.'<br>');

      $sql = "SELECT COUNT(sancion.id) AS SP FROM sancion
      JOIN prestamo ON sancion.prestamo_id=prestamo.id
      JOIN usuario ON prestamo.usuario_id=usuario.id
      JOIN san_estado ON san_estado.id=sancion.san_estado_id
      WHERE san_estado.estado <> 'CUMPLIDO' AND lev_fecha > CURDATE() AND usuario_id = $id_cli
      GROUP BY (prestamo.usuario_id)";
      $resultado = $conexion->query($sql);
      $row = $resultado->fetch_array();
      $can_san = $row["SP"];
      echo('Cantidad: '.$can_san.'<br>');

      if($can_san > 0){
        $sancion = 'VIGENTE';
      }else{
        $sancion = 'NO_VIGENTE';
      }
      echo('SANCION: '.$sancion.'<br><br>');

      //==============================================================================regla1 premisa3 :: validacion
      if ((strcmp($id_usu, $r6p1_cod_val) === 0) && (strcmp($prest_pend, $r6p2_pp_val) === 0) && (strcmp($sancion, $r6p3_san_val) === 0)){
        $usuario = 'AUTORIZADO';
      }else{
        $usuario = 'NO_AUTORIZADO';
      }
      echo('USUARIO: '.$usuario.'<br><br>');

      //==============================================================================regla1 premisa3 :: validacion
      if ((strcmp($busqueda, $r1p1_bus_val) === 0) && (strcmp($libro, $r1p2_lib_val) === 0) && (strcmp($usuario, $r1p3_usu_val) === 0)){
        $prestamo = 'APROBADO';
      }else{
        $prestamo = 'NO_APROBADO';
      }
      echo('PRESTAMO: '.$prestamo.'<br><br>');
    echo('</div>');
  include "./templates/footer.php"
?>
