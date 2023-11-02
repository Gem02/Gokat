<?php

session_start();


if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user'];
    
    require "config/conne.php";
}
if(!isset($user_id)) {
    header('location:login.php');
    exit();
}
$response = '';
if (isset($_POST['searchcode'])) {
    $precode = filter_var($_POST['inputcode'], FILTER_SANITIZE_SPECIAL_CHARS);
    $sql = $dbcon->prepare("SELECT * FROM `customer_payment_details` WHERE `work_code` = ? OR `reference` = ?");
    $sql->execute([$precode, $precode]);
    $show2 = $sql->fetch(PDO::FETCH_ASSOC);
   
    if ($sql->rowCount() < 1) {
        $response = '<div class="confirm">
                        <h1 class="sorry">Sorry!!</h1>
                        <p>This transaction has not been carried out</p>
                     </div>
                     <script>
                        $(function(){
                            toastr.error("No transaction was found", "Sorry");
                        });
                    </script>';
       
    }elseif ($sql->rowCount() > 0 && $show2['status'] === 'success') {
        $response = '<div class="confirm">
                        <h1 class="congrats">Congrats!! </h1> <br/>
                        <p>Your transaction was successful. You can re-download your reciept from the button below.</p><br/><br/>
                        <a href="invoice.php?code='.$precode.'">Download Reciept</a> <br>
                     </div>
                     <script>
                        $(function(){
                            toastr.success("Transaction was successful", "Success");
                        });
                    </script>';
    } 
    
}
    
   
 
?>

<?php include "require/header.php"; ?>


<body>
    <div class="categorieshead">
            <h5>Confirm Payment</h5>
    </div>
    <section class="categories form-container confirmepage">
              <form action="" method="post" class="smallform">
                <p>Transaction code</p>
                <input type="text" name="inputcode" class="box" id="fname" placeholder="Enter code" required value="<?php if(isset($precode)){ echo $precode ;} ?>">
                <input type="submit" value="Retrieve Info" name="searchcode" class="btn">

               
             </form>

             <?php echo $response ?>

        </section>
        
        <script src="https://js.paystack.co/v1/inline.js"></script> 
         <script src="assets\js\payment.js"></script>
</body>
