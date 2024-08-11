function getCountries() {
    fetch('./search/get_countries.php')
      .then(response => response.json())
      .then(data => {
        if (data.data && data.data.status_code === 200) {
          const countries = data.data.countries;
          const tableBody = document.getElementById('country-table-body');
          tableBody.innerHTML = '';

          countries.forEach((country, index) => {
            const row = document.createElement('tr');
            var active = false
            if (country.active === "0") {
              active = false
            } else {
              active = true
            }
            row.innerHTML = `
                <th scope="row">${index + 1}</th>
                <td>${country.name}</td>
                <td><img src="${country.flag}" alt="Flag of ${country.name}" width="50"></td>
                <td>${active ? 'Activo' : 'Inactivo'}</td>
                <td><i class="material-icons btn-edit" data-id="${country.id}" style="color:#000;cursor:pointer;font-size:30px;margin-left:35px;" data-bs-toggle="modal" data-bs-target="#editModal" onclick="getCountryByid('${country.id}')">edit</i></a> </td>
                 <td><i class="material-icons btn-delete" data-id="${country.id}" style="color:#000;cursor:pointer;font-size:30px;margin-left:35px;" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="confirmDelete('${country.id}')">delete</i></a> </td>
                
                `;

            tableBody.appendChild(row);
          });
        } else {
          console.error('Error al cargar los datos');
        }
      })
      .catch(error => console.log('Error en la solicitud:', error));
      //console.log(error)
  }
  //});