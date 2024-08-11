
function deleteCountry(id) {
    fetch('./delete/delete_country.php', {
      method: 'POST',
      body: new URLSearchParams({ id: id })
    })
      .then(response => response.json())
      .then(data => {
        if (data.status_code === 200) {
          deleteSuccessAlert()
          const button = document.querySelector(`.btn-delete[data-id='${id}']`);
          const row = button.closest('tr');
          row.remove();
        } else {
          console.error('Error al eliminar el país:', data.message);
          genericErrorAlert()
        }
      })
      .catch(error => console.error('Error en la solicitud de eliminación:', error));
  }