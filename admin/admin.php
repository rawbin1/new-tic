<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - TIC EATS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        TIC EATS
        <!-- Logout Button -->
        <button class="logout" onclick="logout()">Logout</button>
    </header>
    
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Admin Dashboard</h2>
            <ul>
                <li><a href="#" onclick="showHome()">Home</a></li>
                <li><a href="#" onclick="showContent('user')">User</a></li>
                <li>
                    <!-- Dropdown for Beverage -->
                    <div class="dropdown">
                        <a href="#" onclick="toggleDropdown('beverageDropdown')">Beverage</a>
                        <ul id="beverageDropdown" class="dropdown-content" style="display: none;">
                            <li><a href="#" onclick="showContent('allBeverages')">All Beverages</a></li>
                            <li><a href="#" onclick="showContent('addBeverage')">Add New Beverage</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <!-- Dropdown for Snacks -->
                    <div class="dropdown">
                        <a href="#" onclick="toggleDropdown('snacksDropdown')">Snacks</a>
                        <ul id="snacksDropdown" class="dropdown-content" style="display: none;">
                            <li><a href="#" onclick="showContent('allSnacks')">All Snacks</a></li>
                            <li><a href="#" onclick="showContent('addSnacks')">Add New Snack</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="#" onclick="showContent('order')">Order</a></li>
            </ul>
        </div>
        
        <!-- Main Content -->
        <div class="main-content" id="main-content">
            <!-- Default Content will go here -->
        </div>
    </div>

    <script>
        function showHome() {
            const content = `
                <h1>Welcome to the Admin Dashboard</h1>
                <p>Manage Users, Beverages, Snacks, and Orders from the sidebar options. Select a category from the navigation menu to get started.</p>
            `;
            document.getElementById('main-content').innerHTML = content;
        }

        function showContent(section) {
            let content = '';
            if (section === 'user') {
                fetch('select.php')
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('main-content').innerHTML = data;
                    })
                    .catch(error => console.error('Error loading content:', error));
            } else if (section === 'allBeverages') {
                fetch('allbeverage.php')
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('main-content').innerHTML = `
                            <h1>All Beverages</h1>
                            <div id="beveragesList">${data}</div>
                        `;
                    })
                    .catch(error => console.error('Error loading beverages:', error));
            } else if (section === 'addBeverage') {
                content = `
                    <h1>Add New Beverage</h1>
                    <form id="addBeverageForm" enctype="multipart/form-data">
                        <label for="beverageName">Beverage Name:</label>
                        <input type="text" id="beverageName" name="beverageName" required>
                        <br>
                        <label for="beveragePrice">Price:</label>
                        <input type="number" id="beveragePrice" name="beveragePrice" required>
                        <br>
                        <label for="beveragePhoto">Upload Photo:</label>
                        <input type="file" id="beveragePhoto" name="beveragePhoto" accept="image/*" required>
                        <br>
                        <button type="submit">Add Beverage</button>
                    </form>
                `;
                document.getElementById('main-content').innerHTML = content;
            } else if (section === 'allSnacks') {
                content = `<h1>All Snacks</h1><p>Here you can view all the snacks available in TIC EATS.</p>`;
            } else if (section === 'addSnacks') {
                content = `
                    <h1>Add New Snack</h1>
                    <form id="addSnackForm" enctype="multipart/form-data">
                        <label for="snackName">Snack Name:</label>
                        <input type="text" id="snackName" name="snackName" required>
                        <br>
                        <label for="snackPrice">Price:</label>
                        <input type="number" id="snackPrice" name="snackPrice" required>
                        <br>
                        <label for="snackPhoto">Upload Photo:</label>
                        <input type="file" id="snackPhoto" name="snackPhoto" accept="image/*" required>
                        <br>
                        <button type="submit">Add Snack</button>
                    </form>
                `;
                document.getElementById('main-content').innerHTML = content;
            } else if (section === 'order') {
                content = `<h1>Order Management</h1><p>Here you can manage the orders placed by customers.</p>`;
            }
        }

        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            if (dropdown.style.display === 'none' || dropdown.style.display === '') {
                dropdown.style.display = 'block';
            } else {
                dropdown.style.display = 'none';
            }
        }

        function logout() {
            console.log('Logout function triggered');
            const userConfirmation = confirm("Are you sure you want to log out?");
            if (userConfirmation) {
                alert('Logging out...');
                window.location.href = '../alogin/adminlogin.php'; // Update path if necessary
            } else {
                alert('Logout canceled.');
            }
        }

        // Load Home content by default
        window.onload = showHome;
    </script>
</body>
</html>
