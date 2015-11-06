<?php
$command = sprintf(
    'php -S %s:%d -t %s >test.log 2>&1 & echo $!',
    WEB_SERVER_HOST,
    WEB_SERVER_PORT,
    WEB_SERVER_DOCROOT
);

$output = array();
exec($command, $output);
$pid = (int) $output[0];

sleep(2);
register_shutdown_function(function() use ($pid) {
    echo sprintf('%s - Killing process with ID %d', date('r'), $pid) . PHP_EOL;
    exec('kill ' . $pid);
});
