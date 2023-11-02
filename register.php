<?php

session_start();

$regerrors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Register'])) {

    require "config/conne.php";


    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_SPECIAL_CHARS);
    $date = date('y-m-d H:i:s');
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phoneno = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
    $cpassword = filter_var($_POST['cpassword'], FILTER_SANITIZE_SPECIAL_CHARS);
    $image = 'image/pic-1.jpg';

    if (empty($firstname)) {
        $regerrors['firstname'] = 'First name cannot be empty';
    }
    if (empty($lastname)) {
        $regerrors['lastname'] = 'Last name cannot be empty';
    }
    if (empty($username)) {
        $regerrors['username'] = 'Username cannot be empty';
    }
    if (empty($address)) {
        $regerrors['address'] = 'Address cannot be empty';
    }
    if (empty($email)) {
        $regerrors['email'] = 'email cannot be empty';
    }
    if (empty($phoneno)) {
        $regerrors['phoneno'] = 'phone number cannot be empty';
    }
    if (empty($password)) {
        $regerrors['password'] = 'password cannot be empty';
    }
    if (strlen($password) < 8){
        $regerrors['password'] = "Password should contain at least 6 characters";
    }

    $select_user = $dbcon->prepare("SELECT * FROM `users` WHERE email = ?");
    $select_user->execute([$email]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);
    if($select_user->rowCount() > 0){
        $regerrors['email'] = "Email already exit please use a differnt email";
    }

    $select_user = $dbcon->prepare("SELECT * FROM `users` WHERE username = ?");
    $select_user->execute([$username]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);
    if($select_user->rowCount() > 0){
        $regerrors['username'] = "username already exit please use a differnt username";
    }

    $select_user = $dbcon->prepare("SELECT * FROM `users` WHERE phone = ?");
    $select_user->execute([$phoneno]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);
    if($select_user->rowCount() > 0){
        $regerrors['phoneno'] = "number already exit please use a differnt number";
    }

    if ($password === $cpassword) {
        $mainpassword = password_hash($password, PASSWORD_BCRYPT);
    }else {
        $regerrors['cpassword'] = "Passwords dont match";
    }

    if (empty($regerrors)) {

        try {
            
            $insert_user = $dbcon->prepare("INSERT INTO `users`(firstname, lastname, username, email, phone, address,  password, image) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
            $insert_user->execute([$firstname, $lastname, $username, $email, $phoneno, $address, $mainpassword, $image]);
    
            $_SESSION['successful_reg'] = true;
            header('location:login.php');
            exit();

        } catch (PDOException $e) {
            $regerrors['catch'] = 'Registeration failed please try again later';
        }
    }
}

?>
<?= include "require/guestheader.php"; ?>
<html>
    <body>
        <div class="registerationhead">
            <h5>REGISTER HERE</h5>
        </div>
        <section class="registerpage">
            <form action="" class="form" method="post" autocomplete="ON">
               
                 <span> 
                        
                            <div class="alert alert-success">
                            
                            </div>
              

                      
                            <div class="alert alert-danger">
                            <?php if(!empty($regerrors['catch'])) { echo '<span style="color:red">'.$regerrors['catch'].'</span>'; } ?>
                            
                            </div>
                    
                 </span>
                
                <div class="form-area">
                    <div class="reginfo profileinfo" style="margin-top:20px">
                        <h5>PROFILE INFORMATION</h5>

                        <div class="eachinput">
                            <input type="text" name="firstname" id="firstname" placeholder="Enter First Name"  maxlength="30"
                            value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname']; ?>">
                            <?php if(!empty($regerrors['firstname'])) { echo '<span style="color:red">'.$regerrors['firstname'].'</span>'; } ?>
                        </div>

                        <div class="eachinput">
                            <input type="text" name="lastname" id="lastname" placeholder="Enter Last Name"  maxlength="30"
                            value="<?php if(isset($_POST['lastname'])) echo $_POST['lastname']; ?>">
                            <?php if(!empty($regerrors['lastname'])) { echo '<span style="color:red">'.$regerrors['lastname'].'</span>'; } ?>
                        </div>

                    </div>
                        
                    
                    <div class="reginfo logininfo">
                        <h5>LOGIN INFORMATION</h5>

                        <div class="eachinput">
                            <input type="text" name="username" id="username" placeholder="UserName" maxlength="30"
                            value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>">
                            <?php if(!empty($regerrors['username'])) { echo '<span style="color:red">'.$regerrors['username'].'</span>'; } ?>
                        </div>

                        <div class="eachinput">
                            <input type="password" name="password" id="password" placeholder="Password" maxlength="60"
                            value="<?php if(isset($_POST['password'])) echo $_POST['password']; ?>" autocomplete="new-password">
                            <?php if(!empty($regerrors['password'])) { echo '<span style="color:red">'.$regerrors['password'].'</span>'; } ?>
                        </div>

                        <div class="eachinput">
                            <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password" maxlength="60"
                            value="<?php if(isset($_POST['cpassword'])) echo $_POST['cpassword']; ?>" autocomplete="new-password">
                            <?php if(!empty($regerrors['cpassword'])) { echo '<span style="color:red">'.$regerrors['cpassword'].'</span>'; } ?>
                        </div>

                        <div class="note" style="line-height:10px ;">
                            <i style="color:red; font-size:22px;">*</i>
                            <span style="color:rgb(172, 165, 165); font-size:12px">Password can be changed later</span>
                            

                        </div>
                        

                        
                    </div>


                    <div class="reginfo contactinfo">
                        <h5>CONTACT INFORMATION</h5>

                        <div class="eachinput">
                            <input type="tel" name="phone" id="phone" placeholder="Phone No" maxlength="30"
                            value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>">
                            <?php if(!empty($regerrors['phoneno'])) { echo '<span style="color:red">'.$regerrors['phoneno'].'</span>'; } ?>
                        </div>

                        <div class="eachinput">
                            <input type="email" name="email" id="email" placeholder="Enter eMail" maxlength="60"
                            value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
                            <?php if(!empty($regerrors['email'])) { echo '<span style="color:red">'.$regerrors['email'].'</span>'; } ?>
                        </div>

                        <div class="eachinput">    
                            <input type="text" name="address" id="address" placeholder="Home address" maxlength="60"
                            value="<?php if(isset($_POST['address'])) echo $_POST['address']; ?>">
                            <?php if(!empty($regerrors['address'])) { echo '<span style="color:red">'.$regerrors['address'].'</span>'; } ?>
                        </div>
                    </div>
                    
                    <div class="reginfo acceptterms">
                        
                    </div>
                    <div class="reginfoflex">
                        <div class="reginfo acceptterms rememberme">
                            <input type="checkbox" name="terms" id="terms">
                            <label for="terms"><a href="#">Accept Terms And Conditions</a></label>
                        </div>
                    </div>


                    <button type="submit" name="Register">Register</button>
                        
                    
                        <div class="loginfrmreg"><a href="login.php" > Have an account already? <strong>Login Now</strong></a></div>
                    
                </div>
            </form>
        </section>
    </body>
</html>
