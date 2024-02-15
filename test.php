<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add your custom styles here */
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="text-center">
                    <h4>Scan The QR Code to Make Payment</h4>
                    <p>Total Payment: &#8377; <?php if (isset($_SESSION['total']) && $_SESSION['total'] != 0) {
                                                echo $_SESSION['total'];
                                            } ?></p>
                    <img src="Assets/qr.png" class="img-fluid" alt="QR Code Image">
                    <p>Is Payment Successful?</p>

                    <?php if (isset($_SESSION['total']) && $_SESSION['total'] > 0) { ?>
                        <form id="paymentForm" action="payment.php" method="POST">
                            <button id="noBtn" type="button" name='payment_fail' class="btn btn-danger" style="background-color: red;" onclick="goBack()">No</button>
                            <button id="yesBtn" type="submit" name='payment_success' class="btn btn-success" style="background-color: green;">Yes</button>
                        </form>
                    <?php } else { ?>
                        <!-- Disable buttons when payment cost is 0 -->
                        <button id="noBtn" type="button" class="btn btn-danger" style="background-color: red;" onclick="goBack()" disabled>No</button>
                        <button id="yesBtn" type="button" class="btn btn-success" style="background-color: green;" disabled>Yes</button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

</body>

</html>
