<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.13.4/dist/sweetalert2.min.css">
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9.13.4/dist/sweetalert2.all.min.js"></script>
  <title>Document</title>


</head>

<body>
  <style>
    .swal2-popup {
      font-family: 'Arial', sans-serif;
    }
  </style>

  <?php
  $curl = curl_init();

  $file           = $_FILES['document']['tmp_name'];
  $file_name      = $_FILES['document']['name'];
  $mime_type      = mime_content_type($file);
  $signature      = $_POST['signature'];
  $materai        = $_POST['materai'];
  $stempel        = $_POST['stempel'];
  $is_in_order    = isset($_POST['is_in_order']) ? $_POST['is_in_order'] : '';

  $cfile          = new CURLFile($file, $mime_type, $file_name);

  $data = array(
    "document"    => $cfile
  );
  if ($signature) {
    $data['signature'] = $signature;
  }
  if ($materai) {
    $data['ematerai'] = $materai;
  }
  if ($stempel) {
    $data['estamp'] = $stempel;
  }
  if ($is_in_order == "on") {
    $data['is_in_order'] = 1;
  }

  echo "<pre>";
  print_r(json_encode($data));

  die();

  logProcess("Request : " . json_encode($data));


  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://apix.sandbox-111094.com:443/v2/document/upload',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $data,
    CURLOPT_HTTPHEADER => array(
      'Accept: application/json',
      'apikey: amj6Oqx234ON0kxFoFGt8wQeIRIapIby' //pa dadang
      // 'apikey: w11r7AHgSwzAFm1EYLv17fLdmr9lRnfO' // heru
      // 'apikey: TkhRZ7XmPVEOTNtY3XWq7htqWoGpJntl' pak sugih
    ),
  ));

  $response = curl_exec($curl);
  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

  curl_close($curl);
  echo $response;
  logProcess("Response : " . $response);
  //header("Location: $location?message=success");
  //header("Location: message.php?response=" . urlencode($response));
  // $response = `{"status":"OK","ref_id":"9884dbf3-05df-473c-861d-74c4fa8df15c","code":null,"timestamp":"2023-02-21T14:18:52+07:00","message":null,"data":{"id":"9884dbf3-3c7d-4bac-be11-198c8ab92e99","stamp":[],"sign":[{"email":"heru@gsp.co.id","url":"https:\/\/ttd.sandbox-111094.com\/3x1vH6LBTGa9IP"}]}}`;

  /* ============ insert database ============ */
  $host = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'db_signature';

  $conn = mysqli_connect($host, $username, $password, $dbname);
  if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
  }

  $upload_dir = 'dokumen/';
  $generate_file_name = uniqid() . '_' . $file_name;
  $target_file = $upload_dir . basename($generate_file_name);

  move_uploaded_file($file, $target_file);
  echo "File uploaded successfully!";

  $sql = "INSERT INTO trx_files (file_name, file_path, response_upload) VALUES ('$generate_file_name', '$target_file', '$response')";
  if (mysqli_query($conn, $sql)) {
    echo "";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }


  // $response = '{"status":"OK","ref_id":"98a744cc-bf9a-4b3d-b635-ecab424a11cc","code":null,"timestamp":"2023-03-10T16:50:12+07:00","message":null,"data":{"id":"98a744cc-f4be-4000-8233-469fc07ed957","stamp":[],"sign":[{"teken_id":"HH283D00","email":"heru@gsp.co.id","url":"https://ttd.sandbox-111094.com/ye56dERDtUNLSSh6"},{"teken_id":"HH283D01","email":"heru@gsp.co.id","url":"https://ttd.sandbox-111094.com/df98hGTmKIOP23d4"}]}}';

  $json_response = json_decode($response, true);
  //response update to table 

  // $json_response = json_decode($response, true);
  /*   $file_url = $json_response['data']['sign'][0]['url'];
  $file_data = file_get_contents($file_url);

  // menyimpan file ke dalam direktori tujuan
  file_put_contents($generate_file_name, $file_data);

  // memperbarui path file di database
  $conn = mysqli_connect('localhost', 'username', 'password', 'database');
  $sql = "UPDATE trx_files SET file_path='$file_path' WHERE file_name='$generate_file_name'";
  mysqli_query($conn, $sql);
  mysqli_close($conn); */

  if ($json_response['status'] == "OK") {
    echo "<script>
      Swal.fire({
        title: 'Success!',
        text: 'Request was successful.',
        icon: 'success',
        button: 'OK',
        allowOutsideClick: false,
      });
    </script>";
    /* ============ link url sign ============ */
    $sign = $json_response['data']['sign'];
    foreach ($sign as $idx => $value) {
      echo "url sign-" . ($idx + 1) . " " . "<a href='" . $value["url"] . "'>" . $value["url"] . "</a></br>";
      //print_r($value);
    }
    /* ============ open url sign ============ */
    // $urls = $json_response['data']['sign'];
    // foreach ($urls as $url) {
    //   echo "<script>window.open('" . $url['url'] . "', '_blank')</script>";
    // }
    //redirect($url,'refresh');
  } else {
    $code = $json_response['code'];
    if ($code == "INVALID_PARAMETER") {
      $message = $json_response['message']['document'][0];
    } else if ($code == "SIGNATURE_INVALID_FORMAT") {
      $message = $json_response['message'];
    } else if ($code == "SIGNATURE_INVALID_PAGE") {
      $message = $json_response['message'];
    } else if ($code == "USER_UNREGISTER") {
      $message = $json_response['message'][0];
    } else if ($code == "USER_UNVERIFY_EMAIL") {
      $message = $json_response['message'][0];
    } else if ($code == "USER_INACTIVE") {
      $message = $json_response['message'][0];
    } else if ($code == "DUPLICATE_SIGNER") {
      $message = $json_response['message'];
    } else if ($code == "SYSTEM_FAILURE") {
      $message = $json_response['message'];
    } else if ($code == "CERTIFICATE_FAILED") {
      $message = $json_response['message'][0];
    } else if ($code == "QR_CODE_LIMIT_EXCEED") {
      $message = $json_response['message'];
    } else if ($code == "ESTAMP_NOT_FOUND") {
      $message = $json_response['message'][0];
    } else if ($code == "ESTAMP_INVALID_FORMAT") {
      $message = $json_response['message'];
    } else if ($code == "DUPLICATE_STAMPER") {
      $message = $json_response['message'];
    } else if ($code == "ESTAMP_INVALID_PAGE") {
      $message = $json_response['message'];
    } else if ($code == "DOCUMENT_TYPE_EMATERAI_INVALID") {
      $message = $json_response['message'];
    } else if ($code == "DOCUMENT_VERSION_EMATERAI") {
      $message = $json_response['message'];
    } else if ($code == "EMATERAI_INVALID_PAGE") {
      $message = $json_response['message'];
    } else if ($code == "DOCUMENT_ENCRYPTED") {
      $message = $json_response['message'];
    } else if ($code == "WRONG_PASSWORD_DOCUMENT") {
      $message = $json_response['message'];
    } else {
      $message = $json_response['message'];
    }


    if (is_array($message)) {
      $error_message = $message[0];
    } else {
      $error_message = $message;
    }
    echo "<script>
        Swal.fire({
          title: 'Error!',
          text: 'Message : $error_message',
          icon: 'error',
          button: 'OK',
          allowOutsideClick: false,
        });
      </script>";
  }

  function logProcess($message)
  {
    date_default_timezone_set('Asia/Jakarta');
    $logFile = './log/' . date('Y-m-d') . '.log';
    $handle = fopen($logFile, 'a') or die('Cannot open file: ' . $logFile);
    $time = date('Y-m-d H:i:s');
    $log = "$time - $message\n";
    fwrite($handle, $log);

    fclose($handle);
  }

  function generate_kode_unik($length = 8)
  {
    $char_set = '0123456789abcdef';
    $kode_unik = '';

    // Generate kode unik dengan panjang $length
    for ($i = 0; $i < $length; $i++) {
      $kode_unik .= $char_set[rand(0, strlen($char_set) - 1)];
    }

    return $kode_unik;
  }
  ?>
</body>
<script src="asset/js/sweetalert/sweetalert2.all.min.js"></script>

</html>