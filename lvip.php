<?php

header('Content-Type: text/plain');
$source = 'https://www.nic.lv/local.net';
$list   = 'lv';

$ips = [];
if ($file = fopen($source, 'rb')) {
    while (!feof($file)) {
        $line = trim(fgets($file));
        if (empty($line) || 0 === strpos($line, '#')) {
            continue;
        }
        $ips[] = $line;
    }
    fclose($file);
}
$ips = array_unique($ips);

if (empty($ips)) {
    die("# failed to get ip list\n");
}

echo "/ip firewall address-list\n";
echo "remove [/ip firewall address-list find list=$list]\n";
foreach ($ips as $ip) {
    echo "add list=$list address=$ip\n";
}