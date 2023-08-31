// Datos de usuarios (simulados)
let users = [];

// Función para crear un usuario
function createUser() {
  const name = document.getElementById('nameInput').value;
  const email = document.getElementById('emailInput').value;
  const password = document.getElementById('passwordInput').value;

  // Validar datos (puedes agregar validaciones adicionales según tus necesidades)

  const newUser = {
    name: name,
    email: email,
    password: password
  };

  users.push(newUser);
  renderUserList();
}

// Función para renderizar la lista de usuarios
function renderUserList() {
  const userList = document.getElementById('userList');
  userList.innerHTML = '';

  users.forEach(function(user) {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${user.name}</td>
      <td>${user.email}</td>
      <td>
        <button onclick="editUser('${user.email}')">Editar</button>
        <button onclick="deleteUser('${user.email}')">Eliminar</button>
      </td>
    `;

    userList.appendChild(row);
  });
}

// Función para editar un usuario
function editUser(email) {
  // Implementa la lógica para editar un usuario según tus necesidades
  console.log('Editar usuario con correo electrónico: ' + email);
}

// Función para eliminar un usuario
function deleteUser(email) {
  // Implementa la lógica para eliminar un usuario según tus necesidades
  console.log('Eliminar usuario con correo electrónico: ' + email);
}
