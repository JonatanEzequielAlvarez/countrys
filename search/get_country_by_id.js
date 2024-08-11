function getCountryByid(id) {
    fetch(`./search/get_country_by_id.php?id=${id}`)
      .then(response => response.json())
      .then(data => {
        if (data.status_code === 200) {
          const country = data.country;
          document.getElementById('id').value = country.id;
          document.getElementById('name').value = country.name;
          if (country.active === "0") {
            document.getElementById('active').checked = false;
          } else {
            document.getElementById('active').checked = country.active;
          }

          document.getElementById('modal-id').textContent = country.id;

        } else {
          console.error('Country not found');
        }
      })
      .catch(error => console.error('Error fetching country:', error));
  }