<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html#page-kontakt");
    exit;
}

$name     = isset($_POST["name"])     ? strip_tags(trim($_POST["name"]))     : "";
$firma    = isset($_POST["firma"])    ? strip_tags(trim($_POST["firma"]))    : "";
$email    = isset($_POST["email"])    ? filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL) : "";
$telefon  = isset($_POST["telefon"])  ? strip_tags(trim($_POST["telefon"]))  : "";
$kundentyp= isset($_POST["kundentyp"])? strip_tags(trim($_POST["kundentyp"])): "";
$standort = isset($_POST["standort"]) ? strip_tags(trim($_POST["standort"])) : "";
$branche  = isset($_POST["branche"])  ? strip_tags(trim($_POST["branche"]))  : "";
$frequenz = isset($_POST["frequenz"]) ? strip_tags(trim($_POST["frequenz"])) : "";
$nachricht= isset($_POST["nachricht"])? strip_tags(trim($_POST["nachricht"])): "";

if (!$name || !$email || !$nachricht) {
    header("Location: index.html?status=error#page-kontakt");
    exit;
}

$to = "info@cleany-vollreinigung.de";
$subject = "Neue Angebotsanfrage von $name";

$body = "";
$body .= "Neue Angebotsanfrage\n";
$body .= str_repeat("-", 40) . "\n\n";
$body .= "Name:     $name\n";
$body .= "Firma:    $firma\n";
$body .= "E-Mail:   $email\n";
$body .= "Telefon:  $telefon\n";
$body .= "Typ:      $kundentyp\n";
$body .= "Standort: $standort\n";
$body .= "Branche:  $branche\n";
$body .= "Frequenz: $frequenz\n\n";
$body .= "Nachricht:\n$nachricht\n";

$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

if (mail($to, $subject, $body, $headers)) {
    header("Location: index.html?status=success#page-kontakt");
} else {
    header("Location: index.html?status=error#page-kontakt");
}
exit;
