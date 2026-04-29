const checkbox = document.getElementById('tipoUsuario');
const rolesSelect = document.getElementById('roles');
const userInput = document.getElementById('username');
const subsecretariaSelect = document.getElementById('siglasSubsecretaria');
const subsecretariaLabel = document.getElementById('labelSubsecretaria');
const direccionSelect = document.getElementById('siglasDireccion');
const direccionLabel = document.getElementById('labelDireccion');
const departamentoSelect = document.getElementById('siglasDepartamento');
const departamentoLabel = document.getElementById('labelDepartamento');
const originalSubsecretariaOptions = $('#siglasSubsecretaria').html();
let subsecretariaSiglas = '';

function resetSelectOptions(selectElement, addDefaultOption = true) {
    selectElement.innerHTML = '';
    if (addDefaultOption) {
        var defaultOption = new Option('Seleccione', '', true, true);
        defaultOption.hidden = true;
        selectElement.append(defaultOption);
    }
}

function addRoleOptions(roles, excludeRole) {
    roles.forEach(function(role) {
        if (role !== excludeRole) {
            rolesSelect.add(new Option(role, role));
        }
    });
}

function toggleUserInputFields(isAdmin) {
    const elements = [subsecretariaSelect, subsecretariaLabel, direccionSelect, direccionLabel, departamentoSelect, departamentoLabel];
    elements.forEach(element => element.hidden = isAdmin);
    userInput.readOnly = !isAdmin;
    if (isAdmin) {
        userInput.value = '';
    }
}

checkbox.addEventListener('change', function() {
    resetSelectOptions(rolesSelect, false);
    if (this.checked) {
        rolesSelect.add(new Option('Admin', 'Admin'));
        toggleUserInputFields(true);
    } else {
        addRoleOptions(roles, 'Admin');
        toggleUserInputFields(false);
        $('#siglasSubsecretaria').html(originalSubsecretariaOptions);
        resetSelectOptions(direccionSelect);
        resetSelectOptions(departamentoSelect);
        direccionSelect.disabled = true;
        departamentoSelect.disabled = true;
        userInput.value = '';
    }
});

checkbox.dispatchEvent(new Event('change'));

$(document).ready(function() {
    $('#siglasSubsecretaria').change(function() {
        var id = $(this).val().split('-')[0];
        subsecretariaSiglas = $(this).val().split('-')[1];
        userInput.value = subsecretariaSiglas;
        $.ajax({
            url: '/getDirecciones/'+id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                resetSelectOptions($('#siglasDireccion')[0]);
                resetSelectOptions($('#siglasDepartamento')[0]);
                $.each(data, function(key, value) {
                    $('#siglasDireccion').append(new Option(value, key));
                });
                direccionSelect.disabled = false;
            }
        });
    });

    $('#siglasDireccion').change(function() {
        var id = $(this).val().split('-')[0];
        userInput.value = subsecretariaSiglas + '-' + $(this).val().split('-')[1];
        $.ajax({
            url: '/getDepartamentos/'+id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                resetSelectOptions($('#siglasDepartamento')[0]);
                $('#siglasDepartamento').append(new Option('SIN DEPARTAMENTO', ''));
                $.each(data, function(key, value) {
                    $('#siglasDepartamento').append(new Option(value, key));
                });
                departamentoSelect.disabled = false;
            }
        });
    });

    $('#siglasDepartamento').change(function() {
        var departamentoSiglas = $(this).val() ? $(this).val().split('-')[1] : "";
        if (departamentoSiglas !== "") {
            userInput.value = subsecretariaSiglas + '-' + $('#siglasDireccion').val().split('-')[1] + '-' + departamentoSiglas + '-';
        } else {
            userInput.value = subsecretariaSiglas + '-' + $('#siglasDireccion').val().split('-')[1];
        }
    });
});