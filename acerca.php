<?php include "./templates/nav.php" ?>
<link rel="stylesheet" href="./css/estilos.css">
<div class="container" style="text-align: justify;"><br>
  <h2 style="text-align: center;">SE Préstamo de Libros</h2><br>
  <p>Un usuario desea solicitar el préstamo de un libro. El sistema muestra el catálogo de libros existentes. El usuario puede realizar la búsqueda del material utilizando filtros en cualquiera de sus atributos. Si la búsqueda es exitosa el usuario clickea el botón Seleccionar, a continuación, el sistema le pide que ingrese su documento de identificación, en caso contrario el usuario puede finalizar el proceso, o iniciar una nueva búsqueda. En cuanto el sistema recibe la identificación del usuario y los datos del libro inicia todo el proceso. Primero por seguridad, verifica si el código del libro válido o no, si no lo es vuelve a mostrar los resultados de la búsqueda, pero en caso afirmativo procede a verificar que este esté DISPONIBLE, para lo que su estado deberá ser diferente de PRESTADO o RESERVADO y además ser catalogado como material de CONSULTA EXTERNA, es decir pertenecer únicamente a la colección GENERAL o a la colección de RESERVA. Si no cumple una de estas condiciones el sistema informará este evento al usuario y podrá realizar una nueva búsqueda o finalizar el proceso.</p>

  <div class="container">
    <img src="./img/img3.jpg" alt="" class="imagen1">
  </div>

  <p>A continuación, el Sistema procede a verificar que el usuario este AUTORIZADO para recibir el libro, para ello solicita su número de identificación, si el usuario no se encuentra registrado en la base de datos el sistema informará al usuario quien puede rectificar la información ingresada o dar por terminado el proceso. Si el usuario rectifica la información y esta vuelve a ser inconsistente el Sistema informará al usuario y terminará el proceso (re-dirigiéndolo a la página principal). Si el usuario se encuentra registrado en la base de datos, el sistema comprueba si existen sanciones vigentes registradas a su nombre (con fecha de levantamiento mayor a la fecha actual) , de ser así el usuario no está autorizado  para acceder al préstamo y el sistema le informará, pero si no tiene sanciones pendientes, el sistema verifica que los prestamos pendientes registrados a su nombre no exceda el número máximo, si excede el sistema dará informe al usuario, caso contrario, el sistema determinará que el préstamo es APROBADO, con lo que ya es posible realizar el respectivo registro y presentar el informe.</p>
  <div class="container">
    <h3><li>Objetos</li></h3>
    <img src="./img/img1.jpg" alt="">
  </div>

  <div class="container">
    <h3><li>Reglas</li></h3>
    <img src="./img/img2.jpg" alt="" class="reglas">
  </div>
  <div>
    <br><br><br><h5><li>Sobre las sanciones</li></h5><br>
    <p>Las sanciones se registran con un id automático, el código del usuario al que se le aplica la sanción, la fecha de registro con la respectiva descripción y valor monetario en caso de que exista. Se le asigna un estado que puede tener 3 posibles valores, PENDIENTE (es cuando no se ha realizado el pago respectivo o no se ha cumplido la fecha de levantamiento de la sanción), PAGADO (cuando se ha realizado el pago, pero no se ha cumplido la fecha de levantamiento, CUMPLIDO (cuando la fecha de levantamiento ha finalizado y el valor en caso de que exista ha sido cancelado).</p>
    <p>La fecha predeterminada de levantamiento de sanción será la de finalización de semestre o periodo vigente, esta puede ser modificada cuando exista un valor pendiente de pago y este se cancele, entonces se calculará la fecha de levantamiento a partir de la fecha de pago y proporcional a la falta que se haya cometido (mora en devolución, daño al material, perdida del material...).</p>
    <p>Cuando a un usuario se le registren 3 sanciones, automáticamente se generará una cuarta donde se relacione en descripción la referencia de las 3 sanciones previamente registradas, en el valor se asigne la suma de valores de las sanciones en estado pendiente, y la fecha de levantamiento será la fecha de finalización de periodo, si es que realiza el pago antes de cumplirse esta, caso contrario la fecha será la finalización del siguiente periodo y así hasta que se registre el estado como PAGADO.</p>
  </div>
  <div class="container">
    <br><br><h5><li>Sobre la Base de Datos</li></h5>
    <img src="./img/img4.jpg" alt="" class="bd">
  </div>
</div>

<?php include "./templates/footer.php" ?>