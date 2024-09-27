<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Stock Out Alert</title>
    <style>
        /* Reset and basic styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            color: #333;
        }

        textarea {
            resize: vertical;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }

        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        .alert {
            display: none;
            padding: 10px;
            border-radius: 4px;
            margin-top: 15px;
        }

        .alert.success {
            background-color: #28a745;
            color: #fff;
        }

        .alert.error {
            background-color: #e74c3c;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Product Stock Out Alert</h2>
    <form id="stockOutForm" method="POST" action="add_alert.php">
        <!-- Product Selection -->
        <div class="form-group">
            <label for="product">Product:</label>
            <select id="product" name="product" required>
                <option value="">Select Product</option>
                <option value="Product 1">Product 1</option>
                <option value="Product 2">Product 2</option>
                <option value="Product 3">Product 3</option>
            </select>
            <div id="productError" class="error">Please select a product.</div>
        </div>

        <!-- Price Range Selection -->
        <div class="form-group">
            <label for="price_range">Price Range:</label>
            <select id="price_range" name="price_range" required>
                <option value="">Select Price Range</option>
                <option value="₹20-₹100">₹20-₹100</option>
                <option value="₹100-₹500">₹100-₹500</option>
                <option value="₹500-₹1000">₹500-₹1000</option>
                <option value="₹1000-₹5000">₹1000-₹5000</option>
            </select>
            <div id="priceRangeError" class="error">Please select a price range.</div>
        </div>

        <!-- Quantity Selection -->
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <select id="quantity" name="quantity" required>
                <option value="">Select Quantity</option>
                <option value="1kg">1kg</option>
                <option value="5kg">5kg</option>
                <option value="10kg">10kg</option>
            </select>
            <div id="quantityError" class="error">Please select a quantity.</div>
        </div>

        <!-- Additional Message -->
        <div class="form-group">
            <label for="message">Additional Message:</label>
            <textarea id="message" name="message" rows="4" placeholder="Write any additional message (optional)"></textarea>
        </div>

        <button type="submit">Submit Alert</button>
        <div id="alertMessage" class="alert"></div>
    </form>
</div>

<script>
    // JavaScript form validation
    document.getElementById('stockOutForm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Validation flags
        let valid = true;

        // Product validation
        const product = document.getElementById('product').value;
        const productError = document.getElementById('productError');
        if (product === '') {
            productError.style.display = 'block';
            valid = false;
        } else {
            productError.style.display = 'none';
        }

        // Price range validation
        const priceRange = document.getElementById('price_range').value;
        const priceRangeError = document.getElementById('priceRangeError');
        if (priceRange === '') {
            priceRangeError.style.display = 'block';
            valid = false;
        } else {
            priceRangeError.style.display = 'none';
        }

        // Quantity validation
        const quantity = document.getElementById('quantity').value;
        const quantityError = document.getElementById('quantityError');
        if (quantity === '') {
            quantityError.style.display = 'block';
            valid = false;
        } else {
            quantityError.style.display = 'none';
        }

        if (valid) {
            this.submit();
        }
    });
</script>

</body>
</html>
