<?php

/* ========================= test redirect response sign url ======================= */


$json = '{"status":"OK","ref_id":"98a744cc-bf9a-4b3d-b635-ecab424a11cc","code":null,"timestamp":"2023-03-10T16:50:12+07:00","message":null,"data":{"id":"98a744cc-f4be-4000-8233-469fc07ed957","stamp":[],"sign":[{"teken_id":"HH283D00","email":"heru@gsp.co.id","url":"https://ttd.sandbox-111094.com/ye56dERDtUNLSSh6"},{"teken_id":"HH283D01","email":"heru@gsp.co.id","url":"https://ttd.sandbox-111094.com/df98hGTmKIOP23d4"}]}}';

$response_json = json_decode($json, true);
$urls = $response_json['data']['sign'];

// foreach ($urls as $url) {
//     echo "<script>window.open('" . $url['url'] . "', '_blank')</script>";
// }

$urls = array();
foreach ($response_json['data']['sign'] as $sign) {
    $url = $sign['url'];
    header("Location: $url");
    exit;
}

// foreach ($urls as $url_info) {
//     $url = $url_info['url'];
//     header('Location: ' .  $url_info['url']);
//     exit;
// }
