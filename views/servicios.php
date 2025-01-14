<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios</title>
    <link rel="stylesheet" type="text/css" href="Css/estilo.css">
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>
<body>
    <section class="cards-section">
    <div id="alertError" class="alert alert-danger" role="alert" style="display: none;">
    Ocurrió un error. Intenta nuevamente.
    </div>
        <h2>Manejo de Estudiantes</h2>
        <div class="table-container">
            <table id="dg" title="Estudiantes" class="easyui-datagrid" 
                url="models/acceder.php"
                toolbar="#toolbar" pagination="true"
                rownumbers="true" fitColumns="true" singleSelect="true">
                <thead>
                    <tr>
                        <th field="CED_EST" width="50">Cedula</th>
                        <th field="NOM_EST" width="50">Nombre</th>
                        <th field="APE_EST" width="50">Apellido</th>
                        <th field="DIR_EST" width="50">Direccion</th>
                        <th field="TEL_EST" width="50">Telefono</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div id="toolbar" class="button-container">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="checkLogin('newUser')">Nuevo Estudiante</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="checkLogin('editUser')">Editar Estudiante</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="checkLogin('destroyUser')">Eliminar Estudiante</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="generatePDF()">Generar Reporte FPDF</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="generateIReport()">Generar Reporte Ireport</a>
            <div class="search-container">
                <input id="cedulaInput" class="easyui-textbox" prompt="Ingrese su Cédula" style="width:150px;">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="generatePDFByCedula()">Generar PDF por Cédula</a>
            </div>
        </div>

        <div id="dlg" class="easyui-dialog" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
            <form id="fm" method="post" novalidate>
            <div id="alertErrorInForm" class="alert alert-danger" role="alert" style="display: none;">
                Ocurrió un error. Intenta nuevamente.
            </div>

            <h3>Datos Estudiante</h3>
                <div class="form-field" style="margin-bottom:10px">
                    <input name="cedula" class="easyui-textbox" required="true" label="Cédula:" style="width:100%" 
                        validType="cedulaValid" data-options="prompt:'Ingrese 10 dígitos numéricos'">
                </div>
                <div class="form-field" style="margin-bottom:10px">
                    <input name="nombre" class="easyui-textbox" required="true" label="Nombre:" style="width:100%" 
                    validType="lettersWithAccents" data-options="prompt:'Solo letras'">
                </div>
                <div class="form-field" style="margin-bottom:10px">
                    <input name="apellido" class="easyui-textbox" required="true" label="Apellido:" style="width:100%" 
                    validType="lettersWithAccents" data-options="prompt:'Solo letras'">
                </div>
                <div class="form-field" style="margin-bottom:10px">
                    <input name="direccion" class="easyui-textbox" label="Dirección:" style="width:100%" 
                        data-options="prompt:'Ingrese la dirección'">
                </div>
                <div class="form-field" style="margin-bottom:10px">
                    <input name="telefono" class="easyui-textbox" required="true" label="Teléfono:" style="width:100%" 
                        validType="telefonoValid" data-options="prompt:'Ingrese 10 dígitos numéricos'">
                </div>
            </form>
        </div>
        <div id="dlg-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()">Guardar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancelar</a>
        </div>

    </section>
    <script src="Js/operaciones.js"></script>
    <script>
    window.isLoggedIn = <?php echo isset($_SESSION['usuario']) ? 'true' : 'false'; ?>;
</script>

</body>

</html>
