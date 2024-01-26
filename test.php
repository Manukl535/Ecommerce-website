<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .invoice {
            width: 90%;
            height:85vh;
            margin: 20px auto;
            border: 1px solid #ccc;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .invoice-header {
            text-align: right;
            margin-bottom: 20px;
            margin-right:10px;
            font-weight:bold;
            
            
        }
        .invoice-header h1 {
            margin: 0;
            color: #333;
        }
        .invoice-header p {
            margin: 5px 0;
            color: #555;
        }
        .invoice-body {
            margin-top: 20px;
        }
        .invoice-body p {
            margin: 5px 0;
            color: #333;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
           
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        .invoice-total {
            margin-top: 20px;
            text-align: right;
        }
        .company-profile {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
            style="display:flex; 
            justify-content:center"
        }
        .company-profile h2 {
            margin: 0;
            color: #333;
        }
        .company-profile p {
            margin: 5px 0;
            color: #333;
        }
    </style>
</head>
<body>

<div class="invoice">
<center><h1>Invoice</h1></center>
<div class="invoice-header" >
            <p>Invoice No:1122</p>
            <p>Date:26-Jan-2024</p>
        </div>
        <div class="company-profile">
            <h2>Posh Botique</h2>
            <p>223 Main Street,</p>
            <p>Electonic City,</p> Bengaluru-07
            <p>posh.com</p>
            <p>+91 98765 43210</p>
        </div>
       
        <div class="invoice-body">
            <p><strong>Bill To:</strong> 
            <p>SRISHA L</p>
            <p><strong></strong> 123 Main Street</p>

            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Item 1</td>
                        <td>2</td>
                        <td>$10.00</td>
                        <td>$20.00</td>
                    </tr>
                    <tr>
                        <td>Item 2</td>
                        <td>1</td>
                        <td>$15.00</td>
                        <td>$15.00</td>
                    </tr>
                </tbody>
            </table>

            <div class="invoice-total">
                <p><strong>Total:</strong> $35.00</p>
            </div>
        </div>
        <center><button onclick="window.print()"><i style="font-size:24px" class="fa">&#xf02f;</i></button></center>
    </div>
</body>
</html>
