<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Servicios</title>
    <link rel="stylesheet" type="text/css" href="Css/estilo.css">
    <link rel="icon" href="images/logo.png" type="image/x-icon">
</head>

<body>
    <div class="cards-section">
        <h2>Manejo de Estudiantes</h2>
        <div style="width: 80%; max-width: 900px; margin: 0 auto; overflow-x: auto; margin-left: 28.5%;">
        <table id="dg" title="Estudiantes" class="easyui-datagrid" style="width:700px;height:250px; margin: 0 auto;"
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
        <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="checkLogin('newUser')">Nuevo Estudiante</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="checkLogin('editUser')">Editar Estudiante</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="checkLogin('destroyUser')">Eliminar Estudiante</a>

            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="generatePDF()">Generar Reporte FPDF</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="generateIReport()">Generar Reporte Ireport</a>

            <input id="cedulaInput" class="easyui-textbox" prompt="Ingrese su Cédula" style="width:150px;">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="generatePDFByCedula()">Generar PDF por Cédula</a>
        </div>

        <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
            <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
                <h3>Datos Estudiante</h3>
                <div style="margin-bottom:10px">
                    <input name="cedula" class="easyui-textbox" required="true" label="Cedula:" style="width:100%" onkeypress="return /[0-9]/.test(event.key)">
                </div>
                <div style="margin-bottom:10px">
                    <input name="nombre" class="easyui-textbox" required="true" label="Nombre:" style="width:100%" onkeypress="return /[a-zA-Z\s]/.test(event.key)">
                </div>
                <div style="margin-bottom:10px">
                    <input name="apellido" class="easyui-textbox" required="true" label="Apellido:" style="width:100%" onkeypress="return /[a-zA-Z\s]/.test(event.key)">
                </div>
                <div style="margin-bottom:10px">
                    <input name="direccion" class="easyui-textbox" required="true" label="Direccion:" style="width:100%" onkeypress="return /[a-zA-Z0-9\s]/.test(event.key)">
                </div>
                <div style="margin-bottom:10px">
                    <input name="telefono" class="easyui-textbox" required="true" label="Telefono:" style="width:100%" onkeypress="return /[0-9]/.test(event.key)">
                </div>
            </form>
        </div>
        <div id="dlg-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Guardar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
        </div>
    </div>
    
    <script type="text/javascript">
        var url;

        function checkLogin(action) {
            <?php if (!isset($_SESSION['usuario'])): ?>
                alert('Debes iniciar sesión para realizar esta acción');
                window.location.href = 'index.php?action=login';
            <?php else: ?>
                if (action === 'newUser') {
                    newUser();
                } else if (action === 'editUser') {
                    editUser();
                } else if (action === 'destroyUser') {
                    destroyUser();
                }
            <?php endif; ?>
        }

        function newUser() {
            $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo Estudiante');
            $('#fm').form('clear');
            url = 'models/guardar.php';
        }

        function editUser() {
            var row = $('#dg').datagrid('getSelected'); // Declarar y obtener la fila seleccionada
            if (row) {
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar estudiante:');
                $('#fm').form('load', {
                    cedula: row.CED_EST,
                    nombre: row.NOM_EST,
                    apellido: row.APE_EST,
                    telefono: row.TEL_EST,
                    direccion: row.DIR_EST
                });
                url = 'Models/actualizar.php?cedula=' + row.estCedula;
            }
        }

        function saveUser() {
            $('#fm').form('submit', {
                url: url,
                iframe: false,
                onSubmit: function() {
                    return $(this).form('validate');
                },
                success: function(result) {
                    var result = eval('(' + result + ')');
                    if (result.errorMsg) {
                        $.messager.show({
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    } else {
                        $('#dlg').dialog('close'); // close the dialog
                        $('#dg').datagrid('reload'); // reload the user data
                    }
                }
            });
        }

        function destroyUser() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $.messager.confirm('Confirmar', 'Esta seguro de Eliminar este estudiante?', function(r) {
                    if (r) {
                        $.get('models/eliminar.php', {
                            cedula: row.CED_EST
                        }, function(result) {
                            if (result.success) {
                                $.messager.show({ // show error message
                                    title: 'Error, no se pudo borrar',
                                    msg: result.errorMsg
                                });
                            } else {
                                $('#dg').datagrid('reload'); // reload the user data

                            }
                        }, 'json');
                    }
                });
            }
        }

        function generatePDF() {
            window.location.href = 'reporte.php';
        }

        function generateIReport() {
            window.location.href = 'reportes.php';
        }

        function generatePDFByCedula() {
            var cedula = $('#cedulaInput').val();
            if (cedula) {
                window.location.href = 'report_fpdf.php?cedula=' + encodeURIComponent(cedula);
            } else {
                alert('Por favor, ingrese una cédula.');
            }
        }
    </script>
</body>

</html>
