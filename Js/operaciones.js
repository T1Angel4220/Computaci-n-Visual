var url;

function checkLogin(action) {
    if (!window.isLoggedIn) {
        showErrorMessage('Debes iniciar sesión para realizar esta acción', false);
        
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
        showErrorMessage('Por favor, seleccione un estudiante de la tabla para editar.',false);
    }
}


function saveUser() {
    if (!$('#fm [name="cedula"]').val()) {
        showErrorMessage("Por favor, ingrese la cédula.",true);
        $('#fm [name="cedula"]').focus();
        return false;
    } else if (!validateDigitos($('#fm [name="cedula"]')[0])) {
        showErrorMessage("La cédula no es válida, debe ser 10 dígitos numéricos.",true);
        $('#fm [name="cedula"]').focus();
        return false;
    }

    if (!$('#fm [name="nombre"]').val()) {
        showErrorMessage("Por favor, ingrese el nombre.",true);
        $('#fm [name="nombre"]').focus();
        return false;
    } else if (!validateLetters($('#fm [name="nombre"]')[0])) {
        showErrorMessage("El nombre no es válido, deben ser letras.",true);
        $('#fm [name="nombre"]').focus();
        return false;
    }

    if (!$('#fm [name="apellido"]').val()) {
        showErrorMessage("Por favor, ingrese el apellido.",true);
        $('#fm [name="apellido"]').focus();
        return false;
    } else if (!validateLetters($('#fm [name="apellido"]')[0])) {
        showErrorMessage("El apellido no es válido, deben ser letras.",true);
        $('#fm [name="apellido"]').focus();
        return false;
    }

    if (!$('#fm [name="telefono"]').val()) {
        showErrorMessage("Por favor, ingrese el teléfono.",true);
        $('#fm [name="telefono"]').focus();
        return false;
    } else if (!validateDigitos($('#fm [name="telefono"]')[0])) {
        showErrorMessage("El teléfono no es válido, debe ser 10 dígitos numéricos.",true);
        $('#fm [name="telefono"]').focus();
        return false;
    }

    var row = $('#dg').datagrid('getSelected');
    if (row) {
        var isAnyFieldEdited = false;
        if ($('#fm [name="nombre"]').val() !== row.NOM_EST) isAnyFieldEdited = true;
        if ($('#fm [name="apellido"]').val() !== row.APE_EST) isAnyFieldEdited = true;
        if ($('#fm [name="telefono"]').val() !== row.TEL_EST) isAnyFieldEdited = true;
        if ($('#fm [name="direccion"]').val() !== row.DIR_EST) isAnyFieldEdited = true;

        if (!isAnyFieldEdited) {
            showErrorMessage("Debes editar al menos uno de los campos (nombre, apellido, teléfono o dirección).",true);
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
            console.log(result); 
            try {
                var result = eval('(' + result + ')');
                if (result.errorMsg) {
                    showErrorMessage(result.errorMsg, true);
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
function validateDigitos(input) {
    const value = input.value;
    const isValid = /^[0-9]{10}$/.test(value); 
    input.value = isValid ? value : value.replace(/[^0-9]/g, '');  
    return isValid;
}

function validateLetters(input) {
    const value = input.value;
    const isValid = /^[a-zA-Z\s]+$/.test(value); 
    input.value = isValid ? value : value.replace(/[^a-zA-Z\s]/g, '');
    return isValid;
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
        showErrorMessage('Por favor, seleccione un estudiante de la tabla para eliminar.',false);
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
        showErrorMessage('Por favor, ingrese una cédula.',false);
    }
}

function showErrorMessage(message, isFormError = false) {
    var alertError;
    if (isFormError) {
        alertError = document.getElementById("alertErrorInForm");  
    } else {
        alertError = document.getElementById("alertError");  
    }

    if (alertError) { 
        alertError.innerText = message;  
        alertError.style.display = "block"; 
        setTimeout(function() {
            alertError.style.display = "none";  
        }, 3000);  
    } else {
        console.error("No se encontró el elemento de alerta con el ID: " + (isFormError ? "alertErrorInForm" : "alertError"));
    }
}
