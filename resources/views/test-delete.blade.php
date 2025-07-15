<!DOCTYPE html>
<html>
<head>
    <title>Test Delete Product</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Test Delete Product</h1>
    
    <button onclick="testDelete()">Test Delete Product (ID: 5)</button>
    
    <div id="result"></div>
    
    <script>
    function testDelete() {
        fetch('/products/5', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            console.log('Response status:', response.status);
            console.log('Response headers:', response.headers);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('result').innerHTML = '<p style="color: green;">Success: ' + JSON.stringify(data) + '</p>';
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('result').innerHTML = '<p style="color: red;">Error: ' + error.message + '</p>';
        });
    }
    </script>
</body>
</html>
