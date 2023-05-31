<?php

// GET TASKS for Vyro Retainer > Retainer task list
$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => 'https://curecollective.proofhub.com/api/v3/projects/7585025549/todolists/263718320785/tasks',
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'POST',
CURLOPT_HTTPHEADER => array(
    'User-Agent: AppName (lee.morgan@curecollective.com.au)',
    'X-API-KEY: bb7f3dfb14212df54449865a85627cb8ab207c6b',
    'Cookie: ci_session=a%3A5%3A%7Bs%3A10%3A%22session_id%22%3Bs%3A32%3A%22c2f7cf6892c853fe0cf4a74bc3df5389%22%3Bs%3A10%3A%22ip_address%22%3Bs%3A15%3A%22192.168.142.134%22%3Bs%3A10%3A%22user_agent%22%3Bs%3A42%3A%22AppName+%28lee.morgan%40curecollective.com.au%29%22%3Bs%3A13%3A%22last_activity%22%3Bi%3A1680850662%3Bs%3A9%3A%22user_data%22%3Bs%3A0%3A%22%22%3B%7D7d2700be8b1512e014ab290c3ca3c04d'
),
));

$cure_tasks = curl_exec($curl);
echo '<script>let cureTasks = '.$cure_tasks.'</script>';
$cure_tasks = json_decode($cure_tasks);
curl_close($curl);

?>