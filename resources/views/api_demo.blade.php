<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Demo</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        input, button, textarea { margin: 10px 0; padding: 8px; }
        .container { margin-bottom: 30px; }
    </style>
</head>
<body>
    <h1>API Demo</h1>

    <!-- Section to get all users -->
    <div class="container">
        <h2>Get All Users</h2>
        <button onclick="getAllUsers()">Get Users</button>
        <div id="users"></div>
    </div>

    <!-- Section to create a user -->
    <div class="container">
        <h2>Create a User</h2>
        <input type="text" id="first_name" placeholder="First Name">
        <input type="text" id="last_name" placeholder="Last Name">
        <input type="text" id="mobile" placeholder="Mobile">
        <input type="email" id="email" placeholder="Email">
        <input type="password" id="password" placeholder="Password">
        <button onclick="createUser()">Create User</button>
    </div>

    <!-- Section to get a specific user -->
    <div class="container">
        <h2>Get User by ID</h2>
        <input type="number" id="get_user_id" placeholder="User ID">
        <button onclick="getUser()">Get User</button>
        <div id="user"></div>
    </div>

    <!-- Section to update a user -->
    <div class="container">
        <h2>Update User</h2>
        <input type="number" id="update_user_id" placeholder="User ID">
        <input type="text" id="update_first_name" placeholder="First Name">
        <input type="text" id="update_last_name" placeholder="Last Name">
        <input type="text" id="update_mobile" placeholder="Mobile">
        <input type="email" id="update_email" placeholder="Email">
        <button onclick="updateUser()">Update User</button>
    </div>

    <!-- Section to delete a user -->
    <div class="container">
        <h2>Delete User</h2>
        <input type="number" id="delete_user_id" placeholder="User ID">
        <button onclick="deleteUser()">Delete User</button>
    </div>

    <script>
        const apiUrl = '/api/users';

        // Get all users
        function getAllUsers() {
            axios.get(apiUrl)
                .then(response => {
                    const users = response.data;
                    let html = '<ul>';
                    users.forEach(user => {
                        html += `<li>${user.first_name} ${user.last_name} (${user.email})</li>`;
                    });
                    html += '</ul>';
                    document.getElementById('users').innerHTML = html;
                })
                .catch(error => console.error(error));
        }

        // Create a user
        function createUser() {
            const data = {
                first_name: document.getElementById('first_name').value,
                last_name: document.getElementById('last_name').value,
                mobile: document.getElementById('mobile').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value
            };

            axios.post(apiUrl, data)
                .then(response => alert('User created successfully!'))
                .catch(error => console.error(error));
        }

        // Get a specific user by ID
        function getUser() {
            const userId = document.getElementById('get_user_id').value;
            axios.get(`${apiUrl}/${userId}`)
                .then(response => {
                    const user = response.data;
                    document.getElementById('user').innerText = `Name: ${user.first_name} ${user.last_name}, Email: ${user.email}, Mobile: ${user.mobile}`;
                })
                .catch(error => console.error(error));
        }

        // Update a user
        function updateUser() {
            const userId = document.getElementById('update_user_id').value;
            const data = {
                first_name: document.getElementById('update_first_name').value,
                last_name: document.getElementById('update_last_name').value,
                mobile: document.getElementById('update_mobile').value,
                email: document.getElementById('update_email').value,
            };

            axios.put(`${apiUrl}/${userId}`, data)
                .then(response => alert('User updated successfully!'))
                .catch(error => console.error(error));
        }

        // Delete a user
        function deleteUser() {
            const userId = document.getElementById('delete_user_id').value;
            axios.delete(`${apiUrl}/${userId}`)
                .then(response => alert('User deleted successfully!'))
                .catch(error => console.error(error));
        }
    </script>
</body>
</html>
