<?php

session_start();
            
if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user'];
}
if(!isset($user_id)) {
    header('location:login.php');
    exit();
}

    include "require/header.php";
?>
<body>


    <div class="categorieshead">
            <h5>Transactions</h5>
    </div>
    <section class="categories transactions">
        <div class="contain">
            <div class="transact">
                <div class="payreminder">
                    <p class="p">$600 is on the way coming
                        you will recieve it when services is 
                        confirmed(Done)
                    </p>
                    <h3>Transactions History</h3>
                    <div class="table">
                        <div class="info successful">
                            <p>Successful</p>
                            <span>NGN21,221.76</span>
                        </div>
                        <div class="info successful">
                            <p>Successful</p>
                            <span>NGN7,861.11</span>
                        </div>
                        <div class="info pending">
                            <p>pending</p>
                            <span>NGN102,000.00</span>
                        </div>
                        <div class="info canceled">
                            <p>canceled</p>
                            <span>NGN21,221.76</span>
                        </div>
                        <div class="info successful">
                            <p>Successful</p>
                            <span>NGN21,221.76</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="balance">
                <div class="bal first">
                    <i class="fas fa-user"></i>
                    <p>Available Balance</p>
                    <span>(withdrawable)</span>

                    <h3>NGN12,453.67</h3>
                </div>
                <div class="bal second">
                    <i class="fas fa-user"></i>
                    <p>Withdrawn Amount</p>

                    <h3>NGN46,912.10</h3>
                </div>
                <div class="bal third">
                    <i class="fas fa-user"></i>
                    <p>Total</p>

                    <h3>NGN215,330.41</h3>
                </div>
            </div>
        </div>
        <div class="lastinfo">
            <p>Withdraw to your local bank account at anytime anywhere and recieve credit alert in less than 12hours
                after withdrawal confirmation Gokat services is here to serve you better
            </p>
        </div>
    </section>

</body>