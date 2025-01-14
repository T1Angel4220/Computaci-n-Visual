var url;

function checkLogin(action) {
    if (!window.isLoggedIn) {
        $.messager.alert('Error', 'Debes iniciar sesión para realizar esta acción', 'warning');
        
        setTimeout(function() {
            window.location.href = 'index.php?action=login';
        }, 2000);
    } else {
        if (action === 'newUser') {
            newUser();
        } else if (action === 'editUser') {
            editUser();
        } else if (action === 'destroyUser') {
            destroyUser();
        }
    }
}


function newUser() {
    $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo Estudiante');
    $('#fm').form('clear');

    $('#fm [name="cedula"]').prop('readonly', false);
    $('#fm [name="cedula"]').css('background-color', ''); 
    
    $('#cedulaMensaje').remove();

    url = 'models/guardar.php'; 
}

function editUser() {
    var row = $('#dg').datagrid('getSelected');
    if (row) {
        $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar estudiante:');
        $('#fm').form('load', {
            cedula: row.CED_EST,
            nombre: row.NOM_EST,
            apellido: row.APE_EST,
            telefono: row.TEL_EST,
            direccion: row.DIR_EST
        });

        $('#fm [name="cedula"]').prop('readonly', true);
        $('#fm [name="cedula"]').css('background-color', '#f0f0f0');  

        $('#cedulaMensaje').remove(); 
        $('#fm').append('<div id="cedulaMensaje" style="color: red; font-weight: bold;">La cédula no se puede editar.</div>');

        url = 'models/actualizar.php?cedula=' + row.CED_EST; 
    } else {
        $.messager.alert('Advertencia', 'Por favor, seleccione un estudiante de la tabla para editar.', 'warning');
    }
}

function saveUser() {
    if (!$('#fm').form('validate')) {
        $.messager.alert('Advertencia', 'Por favor, complete todos los campos obligatorios correctamente.', 'warning');
        return false;
    }

    var row = $('#dg').datagrid('getSelected');
    if (row) {
        var originalCedula = row.CED_EST;
        var cedulaInput = $('#fm [name="cedula"]');

        if (cedulaInput.val() !== originalCedula) {
            $.messager.alert('Error', 'La cédula no puede ser modificada.', 'error');
            cedulaInput.val(originalCedula);
            return false; 
        }

        var isAnyFieldEdited = false;
        if ($('#fm [name="nombre"]').val() !== row.NOM_EST) isAnyFieldEdited = true;
        if ($('#fm [name="apellido"]').val() !== row.APE_EST) isAnyFieldEdited = true;
        if ($('#fm [name="telefono"]').val() !== row.TEL_EST) isAnyFieldEdited = true;
        if ($('#fm [name="direccion"]').val() !== row.DIR_EST) isAnyFieldEdited = true;

        if (!isAnyFieldEdited) {
            $.messager.alert('Advertencia', 'Debes editar al menos uno de los campos (nombre, apellido, teléfono o dirección).', 'warning');
            return false;
        }
    }

    $('#fm').form('submit', {
        url: url,
        iframe: false,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(result) {
            try {
                var result = JSON.parse(result);
                if (result.errorMsg) {
                    $.messager.alert('Error', result.errorMsg, 'error');
                } else {
                    $('#dlg').dialog('close');
                    $('#dg').datagrid('reload');
                }
            } catch (e) {
                console.error("Error al parsear JSON:", e);
            }
        }
    });
}

function destroyUser() {
    var row = $('#dg').datagrid('getSelected');
    if (row) {
        $.messager.confirm('Confirmar', '¿Está seguro de eliminar este estudiante?', function(r) {
            if (r) {
                $.get('models/eliminar.php', {
                    cedula: row.CED_EST
                }, function(result) {
                    if (result.errorMsg) {
                        $.messager.show({
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    } else {
                        $('#dg').datagrid('reload');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Advertencia', 'Por favor, seleccione un estudiante de la tabla para eliminar.', 'warning');
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
        $.messager.alert('Advertencia', 'Por favor, ingrese una cédula.', 'warning');
    }
}


$(function() {
    $.extend($.fn.validatebox.defaults.rules, {
        cedulaValid: {
            validator: function(value) {
                return /^\d{10}$/.test(value);
            },
            message: 'La cédula debe tener exactamente 10 dígitos numéricos.'
        },
        lettersWithAccents: {
            validator: function(value) {
                return /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]+$/.test(value);
            },
            message: 'Solo se permiten letras.'
        },
        telefonoValid: {
            validator: function(value) {
                return /^\d{10}$/.test(value);
            },
            message: 'El teléfono debe tener exactamente 10 dígitos numéricos.'
        }
    });
});
