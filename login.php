<?php

session_start();

$loginerror = []; 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Login'])) {

    require "config\conne.php";

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);

    try {

        $select_user = $dbcon->prepare("SELECT * FROM `users` WHERE email = ?");
        $select_user->execute([$email]);
        $user = $select_user->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password'])){
            $_SESSION['user'] = $user['id'];
            $update = $dbcon->prepare("UPDATE users SET `status` = ? WHERE id = ?");
            $update->execute(['Online', $user['id']]);
            header('location:index.php');
            exit();
         }else{
            $loginerror['error'] = 'Invalid login details';
         }

    } catch (PDOException $e) {
        $loginerror['catch'] = 'Login failed please try again later';
    }
}
 
?>
<?= include "require/guestheader.php"; ?>
    <div class="registerationhead">
        <?php if (isset($_SESSION['successful_reg']) && $_SESSION['successful_reg']) { ?>
            <script>
             /*    Toastify({
                    text: 'Registeration successful You can login now',
                    duration: '5000',
                    close: true,
                    gravity: 'top',
                    positionLeft: true,
                    backgroundColor: '#66bb6a',
                }).showToast(); */

                window.alert('Registeration successful, You can login now');
            </script>
        <?php
            unset($_SESSION['successful_reg']);
        }
        ?>
            <h5>LOGIN HERE</h5>
    </div>
    <section class="registerpage">
            <form action="" class="form" method="post" autocomplete="ON">
                
                 
                
                <div class="form-area">
                    <div class="reginfo logininfo">
                        <h5>LOGIN INFORMATION</h5>

                        <span>
                            
                                <div class="alert alert-success">
                                </div>

                                <div class="alert alert-danger">
                                <?php if(!empty($loginerror['catch'])) { echo '<span style="color:red">'.$loginerror['catch'].'</span>'; } ?>
                            
                                </div>
                        </span>
                        <?php if(!empty($loginerror['error'])) { echo '<span style="color:red">'.$loginerror['error'].'</span>'; } ?>
                            
                        <div class="eachinput">
                            <input type="email" name="email" id="email" placeholder="Enter email" maxlength="30" required
                            value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
                            <span style="color:red"></span>
                        </div>

                        <div class="eachinput">
                            <input type="password" name="password" id="password" placeholder="Password" maxlength="60" required
                            value="<?php if(isset($_POST['password'])) echo $_POST['password']; ?>">
                            <span style="color:red"></span>
                        </div>
                        <div class="note" style="line-height:10px ;">
                            <i style="color:red; font-size:22px;">*</i>
                            <span style="color:rgb(172, 165, 165); font-size:12px">Alwaya keep your prifle updated</span>
                        </div>
                    </div>


                    <div class="reginfoflex">
                        <div class="reginfo acceptterms rememberme">
                            <input type="checkbox" name="rememberpassword" id="terms" value="">
                            <label for="terms">Remember Me</label>
                        </div>
                        <div class="reginfo acceptterms reset">
                                    <a class="btn btn-link" href="">
                                       
                                    </a>
                        </div>
                    </div>


                    <button type="submit" name="Login">Login</button>
                        
                    
                    <div class="loginfrmreg"><a href="register.php" > Yet to register an account? <strong>Register Now</strong></a></div>
                    
                </div>
            </form>
        </section>
