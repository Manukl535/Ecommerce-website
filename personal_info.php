<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Information</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    .container {
      width: 50%;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .container h2{
      text-align: center;
    }
    input {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    button {
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
    }
    button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
    <div class="container">
        <h2>Personal Information</h2>
        <button onclick="toggleEdit()">Edit</button>
        <form id="userInfoForm" style="display: none;">
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" value="SRISHA L" required>
          
          <label for="email">Email:</label>
          <input type="text" id="email" name="email" value="srisha@gmail.com" required>
          
          <label for="address">Address:</label>
          <input type="text" id="address" name="address" value="#123 Main St" required>
          
          <label for="phone">Phone:</label>
          <input type="text" id="phone" name="phone" pattern="[0-9]*" required value="9342532878">
          
          <button type="submit">Save Changes</button>
        </form>
        <div id="userInfoDisplay">
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" value="SRISHA L" readonly>
          
          <label for="email">Email:</label>
          <input type="text" id="email" name="email" value="srisha@gmail.com" readonly>
          
          <label for="address">Address:</label>
          <input type="text" id="address" name="address" value="#123 Main St" readonly>
          
          <label for="phone">Phone:</label>
          <input type="text" id="phone" name="phone" pattern="[0-9]*" value="9342532878" readonly>
        </div>
        <form action="/remove_account" method="post">
          <button type="submit" style="background-color: #f44336;">Remove My Account</button>
        </form>
      </div>
    
      <script>
        function toggleEdit() {
          var form = document.getElementById('userInfoForm');
          var display = document.getElementById('userInfoDisplay');
          var editButton = document.querySelector('button');
          
          if (form.style.display === 'none') {
            form.style.display = 'block';
            display.style.display = 'none';
            editButton.textContent = 'Cancel';
          } else {
            form.style.display = 'none';
            display.style.display = 'block';
            editButton.textContent = 'Edit';
          }
        }
      </script>
</body>
</html>