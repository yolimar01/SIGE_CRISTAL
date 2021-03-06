<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.0 Transitional//EN” “http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd”>
<?php header('Access-Control-Allow-Origin: *'); ?>
<script> imagenBoton('botonFiltro', 'ui-icon-search'); $( "#dialog:ui-dialog" ).dialog( "destroy" );</script>
<script>
  $(function() {
    applyPagination();    
  });
</script>
<div id="general">  
    <div id="titulo" class="alinearIzquierda borde_radius_3px separarBordes" >
        <h1><span class="posicitionAbsoluta separarBordes"><?php echo $page_title?></span></h1>
    </div>
    <form id="rol" name="rol" method="POST">
        <div>
            <table id="filtro" class="anchoFiltro borde_radius_3px">
                <tr>
                    <td class="tamano30"> <?php echo FILTRO_CODIGO ?>
                        <input type="text" id="codigo" name="codigo" size="4" maxlength="10" value="<?php if (isset($_POST['codigo'])) echo $_POST['codigo'];?>" onclick="this.value = '';" onkeypress="return acceptNumPos(event,this, true);" /> 
                    </td>                
                    <td class="tamano35"> <?php echo FILTRO_NOMBRE ?> 
                        <input type="text" id="nombre" name="nombre" value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre'];?>" onclick="this.value = '';"/> 
                    </td>
                    <td class="tamano35 alinearDerecha"> 
                        <button id="botonFiltro" class="botonExpande" onclick="abrirHtml('ajaxHTML', 'rol' ,'http://127.0.0.1/SIGE_CRISTAL/Rol/Rol_Controller/buscarRol');">Buscar</button>                     
                    </td>
                </tr>
            </table>
        </div>
        <?php if ($numReg != -1){
            if ($numReg == 0){?>
        <div id="SinReg" class="anchoGeneral ui-state-highlight ui-corner-all tamanoMensajes"> 
                <p class='alinearCentro'>
                    <span class='ui-icon ui-icon-notice floatLeft'/>
                    <?php echo NO_EXISTEN_REGISTROS ?></p>                            
                </p>
        </div>
        <?php }?>        
        <table border="1" cellpadding="0" cellspacing="0" class="anchoTabla borde_radius_3px">
            <thead>
                <tr class="encabezadoFondo alinearCentro">
                        <th class="tamano10"> </th>
                        <th class="tamano10"><?php echo CODIGO ?></th>
                        <th class="tamano25"><?php echo NOMBRE ?></th>
                        <th class="tamano30"><?php echo DESCRIPCION ?></th>
                        <th class="tamano5"><?php echo ESTADO ?></th>
                        <th class="tamano10"><?php echo MOD ?></th>
                        <th class="tamano10"><?php echo DESAC ?></th>
                    </tr>
            </thead>
            <tbody>
            <?php foreach ($rol as $roles):?>
                <tr class="alinearCentro fondoTabla">
                    <input type="hidden" id="seleccion" />
                    <td><input type="radio" id="eliminarProd" name="eliminarProd" value="<?php echo $roles->cod_rol ?>" onclick="verificaSeleccionModRol('<?php echo $roles->cod_rol ?>', '<?php echo $roles->estado ?>');" /></td>
                    <td><?php echo sprintf('%03d',$roles->cod_rol) ?></td>
                    <td>
                        <label id="tipoRolL<?php echo $roles->cod_rol ?>"><?php echo $roles->tipo_rol ?></label>                   
                        <input type="text" id="tipoRol<?php echo $roles->cod_rol ?>" name="tipoRol<?php echo $roles->cod_rol ?>" class="ocultarCampo" size="30" maxlength="30" value="<?php echo $roles->tipo_rol ?>" />
                    </td>
                    <td>
                        <label id="descrRolL<?php echo $roles->cod_rol ?>"><?php echo $roles->descr_rol ?></label>                   
                        <input type="text" id="descrRol<?php echo $roles->cod_rol ?>" name="descrRol<?php echo $roles->cod_rol ?>" class="ocultarCampo" size="70" maxlength="70" value="<?php echo $roles->descr_rol ?>" />
                    </td>
                    <td>
                        <label id="estadoL<?php echo $roles->cod_rol ?>"><?php echo $roles->estado == 'E' ? 'Inactivo' : 'Activo' ?> </label>                   
                        <select id="estado<?php echo $roles->cod_rol ?>" name="estado<?php echo $roles->cod_rol ?>" class="letra_13px ocultarCampo">
                            <option value="A">Activo</option>
                        </select>
                    </td>
                    <td>
                        <a><img onclick=" verificaSeleccion('MensajeModificar', 'rol' , 'http://127.0.0.1/SIGE_CRISTAL/Rol/Rol_Controller/modificarRol', <?php echo $roles->cod_rol ?>)" class="tamano_botones cursorPointer" src="http://127.0.0.1/SIGE_CRISTAL/application/views/img/iconos/Write Document.ico" /></a>                     
                    </td>
                    <td>
                        <?php if ($roles->cant_reg == 0 && $roles->estado == 'A'){ ?>
                            <a><img onclick=" verificaSeleccion('MensajeEliminar', 'rol' , 'http://127.0.0.1/SIGE_CRISTAL/Rol/Rol_Controller/desactivarRol', <?php echo $roles->cod_rol ?>)" class="tamano_botones cursorPointer" src="http://127.0.0.1/SIGE_CRISTAL/application/views/img/iconos/Delete.ico" /></a>                     
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach;?>
            <tr class="alinearCentro fondoTabla">
                <td>
                    <img onclick="verificarIngresoRol('rol', 'http://127.0.0.1/SIGE_CRISTAL/Rol/Rol_Controller/insertarRol');" class="tamano_botones cursorPointer" src="http://127.0.0.1/SIGE_CRISTAL/application/views/img/iconos/Add.ico" />                     
                </td>
                <td>
                    <input type="hidden" id="codigoNew" name="codigoNew" value="<?php echo $ultCod ?>" />
                    <?php echo sprintf('%03d',$ultCod) ?>
                </td>
                <td><input type="text" id="nombreROL" name="nombreROL" size="30" maxlength="30" onclick="this.value = '';"/> </td>
                <td><input type="text" id="descrROL" name="descrROL" size="70" maxlength="70" onclick="this.value = '';"/> </td>
                <td colspan="3"></td>
            </tr>
            </tbody>
        </table>
        <div id="ajax_paging">
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </form>
    <div id ="MensajeError" title="Verifique nombre" class="anchoGeneral tamanoMensajes ocultarCampo">
        <p class='alinearCentro '>
            <span class='ui-icon ui-icon-notice floatLeft'/>
                Disculpe el campo nombre debe estar lleno
        </p>
    </div>
    <div id ="MensajeIngresar" title="Pregunta" class="anchoGeneral tamanoMensajes ocultarCampo ">
        <p class='alinearCentro'>
            <span class='ui-icon ui-icon-notice floatLeft'/>
            <?php echo MENSAJE_INGRESO ?> rol?
        </p>
    </div>
    <div id ="MensajeModificar" title="Pregunta" class="anchoGeneral tamanoMensajes ocultarCampo ">
        <p class='alinearCentro'>
            <span class='ui-icon ui-icon-notice floatLeft'/>
            <?php echo MENSAJE_ACTUALIZAR ?>  rol?
        </p>
    </div>
    <div id ="MensajeEliminar" title="Pregunta" class="anchoGeneral tamanoMensajes ocultarCampo ">
        <p class='alinearCentro'>
            <span class='ui-icon ui-icon-notice floatLeft'/>
            <?php echo MENSAJE_DESACTIVAR ?> rol?
        </p>
    </div>
    <?php }?>     
</div>