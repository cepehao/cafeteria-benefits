function showEmployeeForm() {
    var employeeFormPopup = document.getElementById('employeeFormPopup');
    employeeFormPopup.style.display = 'block';
}

function closeEmployeeForm() {
    var employeeFormPopup = document.getElementById('employeeFormPopup');
    document.getElementById('employeeForm').reset();
    employeeFormPopup.style.display = 'none';
}

function showAddBonusForm(id) {
    var form = document.getElementById('addBonusForm' + id);
    form.style.display = 'block';
}

function hideAddBonusForm(id) {
    var form = document.getElementById('addBonusForm' + id);
    form.reset();
    form.style.display = 'none';
}