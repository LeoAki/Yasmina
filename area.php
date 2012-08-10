<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>AREA</title>
        <!--Js to save----------------------------------------------------->
        <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="js/js.js"></script>
        <!--Js and Css to List----------------------------------------------------->
        <link href="media/css/demo_page.css" rel="stylesheet" type="text/css"/>
        <link href="media/css/demo_table.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="media/js/jquery.js"></script>
        <script type="text/javascript" src="media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="media/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" charset="utf-8">
        /* Define two custom functions (asc and desc) for string sorting */
			jQuery.fn.dataTableExt.oSort['string-case-asc']  = function(x,y) {
				return ((x < y) ? -1 : ((x > y) ?  1 : 0));
			};

			jQuery.fn.dataTableExt.oSort['string-case-desc'] = function(x,y) {
				return ((x < y) ?  1 : ((x > y) ? -1 : 0));
			};

			$(document).ready(function() {
				/* Build the DataTable with third column using our custom sort functions */
				$('#listallamadas').dataTable( {
					"aaSorting": [ [0,'asc'], [1,'asc'] ],
					"aoColumnDefs": [
						{ "sType": 'string-case', "aTargets": [ 2 ] }
					]
				} );
			} );
        </script>
        <!-- -------------------------------------------------------------->
    </head>
    <?php
    /*Importing class for AREA*/
    require_once 'class/Area.php';
    $AREA= new Area();
    /*Locals Variable*/
        $id;$ar;$description;
    /*------------------------------MANTENIMIENTO-----------------------------*/
    /*Save a register*/
    if(isset ($_REQUEST['GRABAR'])){
        if( isset ($_REQUEST['txtid']) && isset ($_REQUEST['txtarea']) && isset ($_REQUEST['txtdescription']) ){
            $AREA->setID($_REQUEST['txtid']);
            $AREA->setAREA(strtoupper( $_REQUEST['txtarea'] ));
            $AREA->setDESCRIPTION(strtoupper($_REQUEST['txtdescription']) );
            $AREA->SAVE();
            header("Location:area.php");
        }
    }
    /*Search a register*/
    if(isset ($_REQUEST['search'])){
        $AREA= Area::SEARCH_ID($_REQUEST['search']);
        $id=$AREA->getID();
        $ar=$AREA->getAREA();
        $description=$AREA->getDESCRIPTION();
        unset ($AREA);
    }
    /*Delete a register*/
    if(isset ($_REQUEST['ELIMINAR'])){
        $code=$_GET['txtid'];
        //$AREA=Area::DELETE_BY_ID($code);
        $AREA=Area::DELETE_BY_ID($_GET['txtid']);
        //$AREA->DELETE_BY_AREA($_REQUEST['txtid']);
        header("Location:area.php");
        unset ($AREA);
    }
    /*------------------------------------------------------------------------*/
    ?>
    <body>
        <?php?>
        <div id="main">
          <script type="text/javascript">

            (function(){
              var bsa = document.createElement('script');
                 bsa.type = 'text/javascript';
                 bsa.async = true;
                 bsa.src = '//s3.buysellads.com/ac/bsa.js';
              (document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);
            })();
          </script>
            
            <?php echo "<form name='frmarea' method='post' action='area.php?GRABAR='".$id."'>"?>
                <fieldset>
                    <legend>GRABAR LLAMADA</legend>
                    <table id='table1'>
                        <tr style="display:none;">
                            <?php echo "<td><input type='text' name='txtid' id='txtid' value='".$id."'/></td>";?>
                        </tr>
                        <tr>
                            <td>AREA: </td>
                            <?php echo "<td><input type='text' name='txtarea' id='txtarea' value='".$ar."'/></td>";?>
                        </tr>
                        <tr>
                            <td>DESCRIPCI&Oacute;N: </td>
                            <?php echo"<td><textarea id='txtdescription' name='txtdescription' cols='50' rows='3'>".$description."</textarea></td>";?>
                        </tr>
                    </table>
                </fieldset>
                <fieldset>
                    <legend>OPCIONES</legend>
                    <table>
                        <tr>
                            <td><input type="reset" id="btnclean" name="btnclean" value="LIMPIAR"/></td>
                            <td><input type="submit" id="btnsave" name="btnsave" value="GRABAR"/></td>
                            <td><input type="button" id="btnlist" name="btnlist" value="LISTAR"/></td>
                            <td><input type="button" id="btndelete" name="btndelete" value="ELIMINAR" </td>
                        </tr>
                    </table>
                </fieldset>
            <?php
            /*----------------------------Div to list-------------------------*/
            echo "<div id='divlist'>";
            echo "<fieldset>";
                echo "<legend>Lista De Areas</legend>
                    <table id='listallamadas' name='listallamadas'>
                        <thead>
                            <tr>
                                <th scope='row'>C&oacute;digo del &Aacute;rea</th>
                                <th scope='row'>&Aacute;rea</th>
                                <th scope='row'>Descripci&oacute;n</th>
                                
                            </tr>
                        </thead>";
                $resulset= Area::LISTT();
                while ($row=mysql_fetch_array($resulset,MYSQL_NUM)){
                    echo "
                        <tr>
                            <td><a href='area.php?search=". '"' .$row[0]. '"' . "'>" . $row[0]. "</a></td>
                            <td>".$row[1]."</td>
                            <td>".$row[2]."</td>
                        </tr>";
                    }echo "
                     </table>
                   </fieldset>
                   </div>
                    ";
              /*--------------------------------------------------------------*/
            ?>




            <?php echo '</form>';?>
            
        </div>
    </body>
</html>
