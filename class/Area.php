<?php
/**
 * Description of Class Area--> this class conduce the methods the AREA
 *
 * @author leoaki
 */
require_once 'Coneccion.php';
class Area extends Coneccion {
    private $ID;
    private $AREA;
    private $DESCRIPTION;
    
    public function getID() {
        return $this->ID;
    }

    public function setID($ID) {
        $this->ID = $ID;
    }

    public function getAREA() {
        return $this->AREA;
    }

    public function setAREA($AREA) {
        $this->AREA = $AREA;
    }

    public function getDESCRIPTION() {
        return $this->DESCRIPTION;
    }

    public function setDESCRIPTION($DESCRIPTION) {
        $this->DESCRIPTION = $DESCRIPTION;
    }
    /*Get tha data of the table Area*/
    public function setDATA($id,$area,$description){
        $this->ID=$id;
        $this->AREA=$area;
        $this->DESCRIPTION=$description;
    }
    /*Save a new area*/
    public function SAVE(){
        try{
            $this->CONECT();
            mysql_query("Call Sp_area('" . $this->ID . "','" . $this->AREA . "','" . $this->DESCRIPTION . "')")
                    or die(mysql_error());
            $this->CLOSE();
        }catch(Exception $exception){
            echo 'Ups!, lo sentimos ocurrio el siguiente error: '.$exception;
        }
    }
    /*DELETE a area*/
    public function DELETE_BY_ID($id){
        try{
            $this->CONECT();
            mysql_query("DELETE FROM YASMINA.AREA where id=".$id)or die(mysql_error());
            $this->CLOSE();
        }catch(Exception $ex){
            echo 'Ups!, lo sentimos ocurrio el siguiente error: '.$ex;
        }
    }
    public function DELETE_BY_AREA($area){
        try{
            $this->CONECT();
            mysql_query("DELETE FROM YASMINA.AREA where area='".$area."'")or die(mysql_error());
            $this->CLOSE();
        }catch(exception $xcpt){
            echo 'Ups!, lo sentimos ocurrio el siguiente error: '.$xcpt;
        }
    }
    /*List all the areas*/
    public function LISTT(){
        $con=new Coneccion();
        $con->CONECT();
        $resulset=mysql_query("SELECT * from YASMINA.AREA order by area");
        $con->CLOSE();
        unset ($con);
        return $resulset;
    }
    /*List all the areas with a condition*/
    public function LISTCONDITION($condition){
        $con=new Coneccion();
        $con->CONECT();
        $resulset=mysql_query("SELECT * from YASMINA.AREA ".$condition." order by area");
        $con->CLOSE();
        unset($con);
        return $resulset;
    }
    /*Search a area by ID*/
    public function SEARCH_ID($id){
        $con=new Coneccion();
        $con->CONECT();
        $AREA=new Area();
        $resulset=mysql_query("SELECT * from YASMINA.AREA where id= ".$id." order by id");
           if($resulset){
               while ($row=mysql_fetch_array($resulset,MYSQL_NUM)){
                   $AREA->setDATA($row[0], $row[1], $row[2]);
               }
           }else{
               echo "NO SE ENCONTRO NINGUN REGISTRO";
           }
           $con->CLOSE();
           unset ($con);
           return $AREA;
    }
    public function SEARCH_AREA($areaname){
        $con=new Coneccion();
        $con->CONECT();
        $AREA=new Area();
        $resulset=mysql_query("SELECT * from YASMINA.AREA where area='".$areaname." ' order by area");
        if($resulset){
            while ($row=mysql_fetch_array($resulset,MYSQL_NUM)){
                $AREA->setDATA($row[0], $row[1], $row[2]);
            }
        }else{
            echo 'NO SE ENCONTRO NINGUN REGISTRO';
        }
        $con->CLOSE();
        unset ($con);
        return $AREA;
    }

}
?>
