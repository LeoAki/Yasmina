<?php
/**
 * Description of the Class Coneccion--> Maneja la coneccion a la base de datos
 *
 * @author leoaki
 */
class Coneccion {
    private $server;
    private $user;
    private $pass;
    private $db;
    private $cone;
    //function to conect to database
    public function CONECT(){
        $this->server="localhost";
        $this->user="root";
        $this->pass="Yasmina";
        $this->db="YASMINA";
        $this->cone=mysql_connect($this->server, $this->user, $this->pass) or die(mysql_error());
        mysql_query("SET NAME 'utf8'");
        mysql_select_db($this->db,$this->cone) or die(mysql_error());
        return $this->cone;
    }
    //function to close the database
    public function CLOSE(){
        mysql_close($this->cone) or die(mysql_error());
    }
    //function to destroy the session
    public function DESTROY(){
        session_destroy();
    }
    //function to consult to the database
    public function CONSULT($consulta){
        return mysql_query($consulta);
    }
}
?>
