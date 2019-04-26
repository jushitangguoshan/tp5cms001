<?php

$access_token = "19_7XpqeWb-CWVkZ3Lk0OO5nyw0IYYwVjihtq27ox832XcESgeMmx0te8rATkgCfsTOPKjJ2TusU1WO8CsfLAirt4mWz0-Nq93wPIcMGtO7UGXrJ33vVdGjyVVH6yU4iPKRXORCLukECl-Dvk_dPRNcAHAIKG";

$url = "https://api.weixin.qq.com/cgi-bin/template/api_set_industry?access_token=%s";
$data = json_encode([
    "industry_id1"=>1,
    "industry_id2"=>2
]);
$res = https_request(sprintf());

function https_request($url,$data = null)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}

