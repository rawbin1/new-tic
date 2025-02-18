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
                    <!-- Dropdown for Product -->
                    <div class="dropdown">
                        <a href="#" onclick="toggleDropdown('productDropdown')">Product</a>
                        <ul id="productDropdown" class="dropdown-content" style="display: none;">
                            <li><a href="#" onclick="showContent('allProducts')">Show All Products</a></li>
                            <li><a href="#" onclick="showContent('addProduct')">Add New Product</a></li>
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
                <p>Manage Users, Products, and Orders from the sidebar options. Select a category from the navigation menu to get started.</p>
            `;
            document.getElementById('main-content').innerHTML = content;
        }

        function showContent(section) {
            if (section === 'user') {
                fetch('select.php')
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('main-content').innerHTML = data;
                    })
                    .catch(error => console.error('Error loading content:', error));
            } else if (section === 'allProducts') {
                fetch('product.php')
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('main-content').innerHTML = `
                            <h1>All Products</h1>
                            <div id="productsList">${data}</div>
                        `;
                    })
                    .catch(error => console.error('Error loading products:', error));
            } else if (section === 'addProduct') {
                const content = `
                    <h1>Add New Product</h1>
                    <form id="addProductForm" enctype="multipart/form-data">
                        <label for="productName">Product Name:</label>
                        <input type="text" id="productName" name="productName" required>
                        <br>
                        <label for="productPrice">Price:</label>
                        <input type="number" id="productPrice" name="productPrice" required>
                        <br>
                        <label for="productType">Product Type:</label>
                        <select id="productType" name="productType" required>
                            <option value="1">Snacks</option>
                            <option value="2">Beverage</option>
                        </select>
                        <br>
                        <label for="productPhoto">Upload Photo:</label>
                        <input type="file" id="productPhoto" name="productPhoto" accept="image/*" required>
                        <br>
                        <button type="submit">Add Product</button>
                    </form>
                `;
                document.getElementById('main-content').innerHTML = content;

                // Add form submit handler using JavaScript
                const form = document.getElementById('addProductForm');
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Prevent default form submission

                    const formData = new FormData(form);

                    fetch('insert_product.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        alert('Product added successfully!');
                        showContent('allProducts');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('There was an error adding the product.');
                    });
                });
            } else if (section === 'order') {
                // Fetch orders from fetch_order.php and display
                fetch('fetch_order.php')
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('main-content').innerHTML = `
                            <h1>Orders</h1>
                            <div>${data}</div>
                        `;
                    })
                    .catch(error => console.error('Error loading orders:', error));
            }
        }

        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.style.display = dropdown.style.display === 'none' || dropdown.style.display === '' ? 'block' : 'none';
        }

        function logout() {
            const userConfirmation = confirm("Are you sure you want to log out?");
            if (userConfirmation) {
                alert('Logging out...');
                window.location.href = '../alogin/adminlogin.php';
            } else {
                alert('Logout canceled.');
            }
        }

        // Load Home content by default
        window.onload = showHome;
    </script>
</body>
</html>
