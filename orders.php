
<!DOCTYPE html>
<html>
<head>
  <title>Orders</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel="stylesheet" href="styles.css">
  <style>
   table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
   
      text-align: center;
      padding: 8px;
    }

    th {
      background-color: #fff;
      border:1px solid black;
      border-left: none;
      border-right: none;
}
           
            

          
  </style>
</head>
<body>
  
  <section id="cart" class="section-p1">
    <h4 style="text-align: center;">Your Orders</h4><br/>
    <table>
      <tr>
        <th>Product</th>
        <th>Description</th>
        <th>Ordered Date</th>
        <th>Order Staus</th>
        <th>Invoice</th>
      </tr>
      <tr>
        <td><img src="Assets/frock6.jpg" alt="Product 1"></td>
        <td>Description of Product </td>
        <td>2024-01-23</td>
        <td>Delivered</td>
        <td><button style="background-color: rgb(81, 182, 81); text-decoration: none; font-weight: 30px; width: 75%; height: 7vh;color: black;font-weight:bold;border:  1px solid black;border-radius: 50px;" onclick="navigateToPage()"><i style="font-size:18px" class="fa">&#xf1c1;</i> Download</button>
        </td>
      </tr>
    
    </table>
    <script>
      function navigateToPage() {
        // Replace 'page-url' with the actual URL of the page you want to navigate to
        window.location.href = 'Assets/Invoice_Format.pdf';
      }
    </script>
 
</body>
</html>