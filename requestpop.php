<?php   

if (!isset($_SESSION['code'])) {
  header('Location:requestpage.php');
  die();
}


?>
<body>

<section class="popoverlay active">
      <button class="show-modal"></button>
      <span class="overlay"></span>
      
      <div class="modal-box">
            <i class="fas fa-check-circle"></i>
            <h2 class="suc">Success</h2>
            <div class="code">
                <span>Your transaction code is: <strong><?= $_SESSION['code'] ?></strong></span>
            </div>
            <h3>You have <strong>Sucessfully</strong> placed a work request. 
            To complete the process, make the payment of the services now. The worker gets the Money only 
            when the work is completed... <span style="color: rgb(17, 116, 47); font-weight: 700;">Read more</span></h3>

            <div class="buttons">
            <button class="close-btn"><a href="paymentpage.php">Proceed</a> </button>
            <button class="later-btn"><a href="index.php">Pay Later</a> </button>
            </div>
      </div>
</section>
  <style>
    *{
      font-family: "Poppins", sans-serif;
    }
    a{
      font-size: 15px;
      text-decoration: none;
      color: white;
    }
  .popoverlay .close-btn{
  font-size: 18px;
  font-weight: 400;
  color: #fff;
  padding: 14px 22px;
  border: none;
  background: rgb(67, 121, 83);
  border-radius: 6px;
  cursor: pointer;
  }
  .popoverlay .close-btn:hover {
  background-color: rgb(17, 116, 47);
  }

  .popoverlay .later-btn{
  font-size: 18px;
  font-weight: 400;
  color: black;
  padding: 14px 22px;
  border: none;
  background: #f39c12;
  border-radius: 6px;
  cursor: pointer;
  }
  .overlay{
    background: rgb(19, 18, 18,.6);
    height:100%;
    width:100%;
    position: absolute
  }
  .popoverlay .later-btn:hover {
  background-color: #a39c13;
  }
  .popoverlay button.show-modal,
  .popoverlay .modal-box {
  position: fixed;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  }
  .popoverlay.active .show-modal {
  display: none;
  }
  .code{
    margin: 10px;
    font-size: 15px;
    padding-bottom: 5px;
    border-bottom: solid 1px green;
  }
  .popoverlay .modal-box {
  display: flex;
  flex-direction: column;
  align-items: center;
  max-width: 400px;
  width: 70%;
  padding: 30px 20px;
  border-radius: 24px;
  background-color: #fff;
  opacity: 0;
  pointer-events: none;
  transition: all 0.3s ease;
  transform: translate(-50%, -50%) scale(1.2);
  }
  .popoverlay.active .modal-box {
  opacity: 1;
  pointer-events: auto;
  transform: translate(-50%, -50%) scale(1);
  }
  .popoverlay .modal-box i {
  font-size: 75px;
  color: #038f31;
  }
  .popoverlay .modal-box h2 {
  margin: 10px 0;
  font-size: 30px;
  font-weight: 500;
  color: rgb(66, 192, 104);
  }
  .popoverlay .modal-box h3 {
  font-size: 13px;
  font-weight: 400;
  color: #333;
  text-align: center;
  margin-top: -10px;
  }
  .popoverlay .modal-box .buttons {
  margin-top: 15px;
  }
  .popoverlay .modal-box button {
  font-size: 14px;
  padding: 6px 12px;
  margin: 0 10px;
  }
</style>

    <script>
      function popoverlay() {
        const section = document.querySelector("section"),
        overlay = document.querySelector(".overlay"),
        showBtn = document.querySelector(".show-modal"),
        closeBtn = document.querySelector(".close-btn");
      
        section.classList.add("active");

        section.classList.remove("active");

        section.classList.remove("active");
      }

      window.alert("Please copy your transaction code and keep it save");
    </script>
</body>
    
