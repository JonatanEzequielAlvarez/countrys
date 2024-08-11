function update() {
    const id = document.getElementById('id').value;
    const name = document.getElementById('name').value;
    const active = document.getElementById('active').checked ? 1 : 0;

    const formData = new FormData();
    formData.append('id', id);
    formData.append('name', name);
    formData.append('active', active);

    fetch('./update/update_country.php', {
      method: 'POST',
      body: formData
    })
      .then(response => response.json())
      .then(data => {
        if (data.status_code === 200) {

          updateSuccessAlert()

          const row = document.querySelector(`.btn-edit[data-id='${id}']`).closest('tr');
          row.cells[1].textContent = name;
          row.cells[3].textContent = active ? 'Activo' : 'Inactivo';


          const editModal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
          editModal.hide();
        } else {
          genericErrorAlert()
          console.error('Error al actualizar el país:', data.message);
        }
      })
  }