document.addEventListener('DOMContentLoaded', function() {
    // Event listeners for buttons
    document.querySelector('button[onclick="showCustomerDetails()"]').addEventListener('click', showCustomerDetails);
    document.querySelector('button[onclick="showShopOwnerDetails()"]').addEventListener('click', showShopOwnerDetails);

    // Fetch data and populate tables
    function showCustomerDetails() {
        document.getElementById('customer-list').classList.remove('hidden');
        document.getElementById('shopowner-list').classList.add('hidden');
        fetchCustomerData();
    }

    function showShopOwnerDetails() {
        document.getElementById('shopowner-list').classList.remove('hidden');
        document.getElementById('customer-list').classList.add('hidden');
        fetchShopOwnerData();
    }

    function fetchCustomerData() {
        fetch('get_customers.php') // PHP script to fetch customer data
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('customerTableBody');
                tableBody.innerHTML = ''; // Clear previous data
                data.forEach(customer => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${customer.id}</td>
                        <td>${customer.name}</td>
                        <td>${customer.email}</td>
                        <td><button onclick="editCustomer(${customer.id})">Edit</button></td>
                    `;
                    tableBody.appendChild(row);
                });
            })
            .catch(error => console.error('Error fetching customer data:', error));
    }

    function fetchShopOwnerData() {
        fetch('get_shop_owners.php') // PHP script to fetch shop owner data
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('shopOwnerTableBody');
                tableBody.innerHTML = ''; // Clear previous data
                data.forEach(shopOwner => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${shopOwner.id}</td>
                        <td>${shopOwner.name}</td>
                        <td>${shopOwner.businessName}</td>
                        <td><button onclick="editShopOwner(${shopOwner.id})">Edit</button></td>
                    `;
                    tableBody.appendChild(row);
                });
            })
            .catch(error => console.error('Error fetching shop owner data:', error));
    }

    window.editCustomer = function(id) {
        // Handle customer edit
        console.log('Edit customer with ID:', id);
    };

    window.editShopOwner = function(id) {
        // Handle shop owner edit
        console.log('Edit shop owner with ID:', id);
    };
});
