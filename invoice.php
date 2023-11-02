<?php

    session_start();

    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    }else {
        header('location:logout.php');
        exit();
    }

    if (isset($_GET['code'])) {
        $code = $_GET['code'];
        include "config/conne.php";
    }else {
        header('location:paymentpage.php');
        exit();
    }

    $sql = $dbcon->prepare("SELECT * FROM `customer_payment_details` WHERE `work_code` = ? OR `reference` = ?");
    $sql->execute([$code, $code]);
    $show2 = $sql->fetch(PDO::FETCH_ASSOC);
    if ($show2['status'] != 'success') {
        header('location:paymentpage.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="invoice.css">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

</head>
<body>
    <div class="general">
        <div class="button">
            <button id="download">Download</button>
        </div>

        <div class="main" id="main">
            <?php
            $sql3 = $dbcon->prepare("SELECT * FROM `customer_payment_details` WHERE `work_code` = ? OR `reference` = ?");
            $sql3->execute([$code, $code]);
            $show3 = $sql3->fetch(PDO::FETCH_ASSOC);

            $ql = $dbcon->prepare("SELECT * FROM `work_request` WHERE `work_code` = ?");
            $ql->execute([$code]);
            $display = $ql->fetch(PDO::FETCH_ASSOC);

            ?>
           <div class="environment">
                <div class="top">
                    <div><img src="image/goka-last-logo.png" alt="logo" style="width: 80px;"></div>
                    <p>Sales Invoice</p> 
                </div> <hr>
               

               <div class="founder">

                    <div>
                        <p>Diye Dachom Zarmaganda</p>
                        <p>Plateau State, Nigeria</p>
                        <p>+234 901 9606 073 </p>
                    </div>

                    <div class="invoice">
                        <h3>Invoice</h3>
                        <h1><?= $show3['work_code'] ?></h1>
                        <p><strong>Date: </strong> <?= $show3['date'] ?> </p>
                    </div>

              </div>

              
              <div class="inpay">
                    <div class="invoiceto">
                        <span class="texthead">INVOICE TO</span>
                        <h3><?= $display['requestor_name'] ?></h3>
                        <p><?= $display['requestor_address'] ?></p>
                        <p><?= $display['requestor_phoneno'] ?></p>
                    </div>

                    <div class="paymentdetails">
                            <span class="texthead">PAYMENT DETAILS</span>
                            <div class="list side">
                                <div class="listinfo head">
                                    <p>
                                        <h5 class="my-2">Total Due:</h5>
                                    </p>
                                    <p>Bank name:</p>
                                    <p>Country:</p>
                                    <p>City:</p>
                                    <p>Address:</p>
                                    <p>REFERENCE code:</p>
                                </div>

                                <div class="listinfo side">
                                    <p>
                                        <h5 class="">$1,090</h5>
                                    </p>
                                    <p><span class="">Access Bank</span></p>
                                    <p>Nigeria</p>
                                    <p>Jos, Plateau State</p>
                                    <p>Zarmaganda rayfieldroad jos</p>
                                    <p><span class="">BHDHD98273BER</span></p>
                                </div>
                            </div>
                    </div>
              </div>

              <div class="table-responsive">
                <table class="table table-lg">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Rate</th>
                            <th>Hours</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <h6 class="mb-0">Arts and design template</h6> <span class="text-muted">in
                                    reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                    pariatur.Duis aute irure dolor in reprehenderit</span>
                            </td>
                            <td>$120</td>
                            <td>180</td>
                            <td><span class="font-weight-semibold">$300</span></td>
                        </tr>
                        
                    </tbody>
                </table>
              </div>
              <div class="card-body">
                <div class="d-md-flex flex-md-wrap">
                    <div class="pt-2 mb-3 wmin-md-400 ml-auto">
                        <h6 class="mb-3 text-left">Total due</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th class="text-left">Subtotal:</th>
                                        <td class="text-right">$1,090</td>
                                    </tr>
                                    <tr>
                                        <th class="text-left">Tax: <span class="font-weight-normal">(25%)</span></th>
                                        <td class="text-right">$27</td>
                                    </tr>
                                    <tr>
                                        <th class="text-left">Total:</th>
                                        <td class="text-right text-primary">
                                            <h5 class="font-weight-semibold">$1,160</h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              </div>

             <div class="footer">
                <p>Your satisfactio is our greatest reward. We appreciate your trust in GOKAT SERVICES
                    for your service needs. Your payment is not just a transaction but rather a testament to the trust 
                    you've placed on us. Our commitment to delivering top-notch quality and 
                    unparalleled customer service remains unwavering. We look forward to serving you 
                    again the future, and your feedback is invaluable in helping us improve. Thank you for choosing us.
                </p>
             </div>

           
            </div>
        </div>


    </div>

    <script>
        window.onload = function () {
            document.getElementById("download")
                .addEventListener("click", () => {
                    const invoice = this.document.getElementById("main");
                    console.log(invoice);
                    console.log(window);
                    var opt = {
                        margin: 1,
                        filename: 'Gokatinvoice.pdf',
                        image: { type: 'jpeg', quality: 0.98 },
                        html2canvas: { scale: 2 },
                        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
                    };
                    html2pdf().from(invoice).set(opt).save();
                })
        }
    </script>
</body>
</html>