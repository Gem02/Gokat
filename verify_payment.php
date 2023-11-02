<?php
  session_start();
    $ref = $_GET['reference'];

    if (empty($ref)) {
        header('location:javascript://history.go(-1)');
        exit();
    }

    $curl = curl_init();

  

  curl_setopt_array($curl, array(

    CURLOPT_URL => "https://api.paystack.co/transaction/verify/". rawurlencode($ref),

    CURLOPT_RETURNTRANSFER => true,

    CURLOPT_ENCODING => "",

    CURLOPT_MAXREDIRS => 10,

    CURLOPT_TIMEOUT => 30,

    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

    CURLOPT_CUSTOMREQUEST => "GET",

    CURLOPT_HTTPHEADER => array(

      "Authorization: Bearer sk_test_208e3ef314f1e5629dc5b3a8feb22bd18b87b25d",

      "Cache-Control: no-cache",

    ),

  ));

  

  $response = curl_exec($curl);

  $err = curl_error($curl);


  curl_close($curl);

  

  if ($err) {

    echo "cURL Error #:" . $err;

  } else {

    //echo $response;

    $result = json_decode($response);
  }

  if ($result->data->status === 'success') {
    $status = $result->data->status;
    $reference =  $result->data->reference;
    $transcode = $result->data->customer->first_name;
    $email = $result->data->customer->email;

    date_default_timezone_set('Africa/Lagos');
    $date = date('m/d/y h:i:s a,', time());
    include ('config\conne.php');
    $stmt = $dbcon->prepare("INSERT INTO customer_payment_details (status, reference, work_code, date, email) VALUES (?,?,?,?,?)");
    $stmt->execute([$status, $reference, $transcode, $date, $email]);

    if (!$stmt) {
        echo "There was a problem in your code". mysqli_error($dbcon);
    }else {
        header('Location:success.php?status='.$transcode.'');
        die();
    }
    $stmt->close();
    $dbcon->close();

  }else {
    header('location:paymenterrorpage.php');
    die();
  }

?>