<?php


include_once 'conectadb.php';

class alumnos {

    public $id;
    public $alumno;
    public $nombre;
    public $sexo;

    public function __construct($id, $alumno, $nombre, $sexo) {
        $this->id = $id;
        $this->alumno = $alumno;
        $this->nombre = $nombre;
        $this->sexo = $sexo;
    }

    public static function consultar() {
        $mysqli = conectadb::dbmysql();
        $consulta = "select * from alumnos";
       
        // echo ('br');

        $resultado = mysqli_query($mysqli, $consulta);
        if (!$resultado) {
            echo 'No pude realizar la consulta a la base';
            exit;
        }
        $listaAlumnos = [];
        while ($alumno = mysqli_fetch_array($resultado)) {
            $listaAlumnos[] = new alumnos($alumno['id'], $alumno['alumno'], $alumno['nombre'], $alumno['sexo']);
        }

        //$mysquli->close;
        return $listaAlumnos;
    }
     //NUEVO consultarAlumno
         
        public static function consultarAlumno($_idalumno) {
            $mysqli = conectadb::dbmysql();
            $stmt = $mysqli->prepare('SELECT * FROM alumnos WHERE id = ?');
            $stmt->bind_param('i', $_idalumno);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $fila = $resultado->fetch_array();
            return $fila;
        }
        //terimina consultarAlumns
    public static function login($_user, $_password) {
        $mysqli = conectadb::dbmysql();
        $stmt = $mysqli->prepare('SELECT user, pass FROM user WHERE user =? and pass=?');
        $stmt->bind_param('ss', $_user,$_password);
       
        $stmt->execute();
        $resultado = $stmt->get_result();

        while ($filasql = mysqli_fetch_array($resultado)) {

            session_start();
            
            $_SESSION['loggedUserName'] = $filasql['user'];
        }
        $acceso = false;
        if ($stmt->affected_rows == 1) {
            $acceso = true;
        }
        $mysqli->close();
        return $acceso;
    }
    public static function delete($_idalumno) {
        $mysqli = conectadb::dbmysql();

        $stmt = $mysqli->prepare('DELETE FROM alumnos WHERE id = ? ');
        $stmt->bind_param('i', $_idalumno);
        $stmt->execute();
        $resultado = $stmt->get_result();
    }
    
    //AQUI ABAJO EMPIEZA LO DE EDITAR
     public static function edit($_id, $_nombre, $_sexo) 
        {
            $mysqli = conectadb::dbmysql();
            $stmt =$mysqli->prepare ('UPDATE alumnos SET nombre =?, sexo=? WHERE id =? ');
            $stmt->bind_param("ssi",$_nombre,$_sexo,$_id);
            $stmt -> execute();
            $resultado = $stmt->get_result();
            $acceso = false;
            if ($stmt->affected_rows == 1) {
                $acceso = true;
            }
            $mysqli->close();
            return $acceso;
        }
        //fin editar
        //EMPIEZA INSERT
         public static function insert($_matricula, $_nombre, $_sexo) {
            $mysqli = conectadb::dbmysql();
            $stmt = $mysqli->prepare('INSERT INTO alumnos(alumno, nombre, sexo) VALUE (?,?,?)');
            $stmt->bind_param('sss', $_matricula, $_nombre, $_sexo);
            $stmt->execute();
            $acceso = false;
            if ($stmt->affected_rows == 1) {
                $acceso = true;
            }
            $mysqli->close();
            return $acceso;
        }//termina insert
}
?>