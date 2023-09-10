<?php
$slackName = $_GET['slack_name'] ?? '';
$track = $_GET['track'] ?? '';
$indexfile = 'https://github.com/gitoonga/hng/api/index.php';
$sourcecode = 'https://github.com/gitoonga/hng';


function jsonResponse($slackName, $track, $indexfile, $sourcecode) {
    $dayOfWeek = date("l");
    $tz = new DateTimeZone('UTC');
    $currenttime = new DateTime('now', $tz);
    $utcTime = $currenttime->format('Y-m-d\TH:i:s\Z');

    if ($utcTime === false) {
        $response = [
            'error' => 'UTC time validation failed',
        ];
    } else {
        $response = [
            'slack_name' => $slackName,
            'day_of_week' => $dayOfWeek,
            'utc_time' => $utcTime,
            'track' => $track,
            'github_file_url' => $indexfile,
            'github_source_url' => $sourcecode,
            'status_code' => (int) 200,
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

if ($slackName && $track && $indexfile && $sourcecode) {
    jsonResponse($slackName, $track, $indexfile, $sourcecode);
} else {
    
    $response = [
        'error' => 'Missing required parameters',
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
