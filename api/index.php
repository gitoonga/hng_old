<?php
$slackName = $_GET['slack_name'] ?? '';
$track = $_GET['track'] ?? '';
$indexfile = 'test_index';
$sourcecode = 'test_source';


function jsonResponse($slackName, $track, $indexfile, $sourcecode) {
    $dayOfWeek = date("l");
    $utcTime = date("c");

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

// Check if all required parameters are provided
if ($slackName && $track && $indexfile && $sourcecode) {
    jsonResponse($slackName, $track, $indexfile, $sourcecode);
} else {
    // Handle missing parameters
    $response = [
        'error' => 'Missing required parameters',
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
