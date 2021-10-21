<?php
  $sql = "SELECT libro.id,titulo,editorial,coleccion,estado FROM libro
  JOIN editorial ON libro.editorial_id = editorial.id
  JOIN coleccion ON libro.coleccion_id = coleccion.id
  JOIN lib_autor ON libro.id = lib_autor.libro_id
  JOIN autor ON lib_autor.autor_id = autor.id
  JOIN lib_estado ON lib_estado.id = libro.lib_estado_id
  GROUP BY libro.id";

  if($resultado = $conexion->query($sql)){
    echo('
      <div class="container" style="margin-top: 50px;">
      <table id="example" class="table table-striped" style="width:100%">
      <thead>
          <tr>
              <th>Id</th>
              <th>Nombre Libro</th>
              <th>Editorial</th>
              <th>Colección</th>
              <th>Autores</th>
              <th>Seleccionar</th>
          </tr>
      </thead>
      <tbody>
    ');
    while($row = $resultado->fetch_array()){
      $j = $j + 1;
      $id = $row['id'];
      $titulo = $row['titulo'];
      $editorial = $row['editorial'];
      $coleccion = $row['coleccion'];
      $estado = $row['estado'];
      echo('
        <tr>
          <th scope="row">'.$id.'</th>
          <td>'.$titulo.'</td>
          <td>'.$editorial.'</td>
          <td>'.$coleccion.'</td>
          <td>');
            $sql1 = " SELECT autor.autor FROM autor
              JOIN lib_autor ON autor.id =lib_autor.autor_id
              JOIN libro ON libro.id = lib_autor.libro_id
              WHERE libro.id = $id";
              $aux = '|';
            if($resultado1 = $conexion->query($sql1)){
              while($row1 = $resultado1->fetch_array()){
                $i = $i + 1;
                $autor[$i] = $row1['autor'];
                $aux = $aux.$autor[$i].'|';

              }
            }

          echo($aux.'</td>
          <td>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal'.$j.'">
              Seleccionar Libro
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal'.$j.'" tabindex="-1" aria-labelledby="exampleModalLabel'.$j.'" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel'.$j.'">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form class="formLibros'.$j.'" id="formLibros'.$j.'" method="POST">
                      <input type="hidden" id="index" name="index" value="'.$j.'">
                      <input type="hidden" id="id" name="id" value="'.$id.'">
                      <input type="hidden" id="coleccion" name="coleccion" value="'.$coleccion.'">
                      <input type="hidden" id="estado" name="estado" value="'.$estado.'">
                      <div class="mb-3">
                        <label for="id_cli" class="form-label">Identificación</label>
                        <input type="number" class="form-control" id="id_cli" name="id_cli" required value="1000000000">
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="button" name="enviar'.$j.'" id="enviar'.$j.'" value="Enviar'.$j.'" onclick="buscar('.$j.');" class="btn btn-success">
                    </form>
                  </div>
                </div>
              </div>
            </div></td>
        </tr>
      ');
    }
    echo(' <div id="resultado"></div> ');
    echo('
            </tbody>
            <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Nombre Libro</th>
                  <th>Editorial</th>
                  <th>Colección</th>
                  <th>Autores</th>
                  <th>Seleccionar</th>
                </tr>
            </tfoot>
        </table>
      </div>
    ');
  }
?>