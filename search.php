<?php
require_once "autoloader.php";

if(!isset($_GET['search']) && !isset($_GET['time'])){
    return;
}else{
    $search = $_GET['search'];
    $time = $_GET['time'];
    /*$channelType = $_GET['channelType'];*/
    $type = $_GET['type'];
}
try{
$html = "";
$client = new Google_Client();
$client->setApplicationName("yfilter");
$client->setDeveloperKey($_ENV['youtubeApiKey']);

$service = new Google_Service_YouTube($client);

$searchResponse = $service->search->listSearch('id,snippet', array(
    'q' => $search,
    'maxResults' => '12',
    'type' => 'video',
    'safeSearch' => 'none',
    'videoDuration' => $time,
    'videoDefinition' => 'high',
    /*'channelType' => $channelType,*/
    'type' => $type
    ));

foreach ($searchResponse as $video){
    $videoIds = $video['id']['videoId'];
}

foreach ($searchResponse as $thumbnail){
    $id = $thumbnail['id']['videoId'];
    $statistics = $service->videos->listVideos(
        'statistics',
        array(  'id' => $id,
                'maxResults' => '1'));
    $html .= '<a href="https://www.youtube.com/watch?v='.$id.'" target="_blank">';
    $html .= '<span> Likes: '.$statistics["items"][0]["statistics"]["likeCount"].'</span>';
    $html .= '<img src="'.$thumbnail['snippet']['thumbnails']['medium']['url'].'" />';
    $html .= '</a>';

}
return $html;

}catch(Google_Exception $ge){
    echo $ge;
}catch(Google_Service_Exception $gse){
    echo $gse;
}