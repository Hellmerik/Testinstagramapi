<? session_start(); ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title> Диалог </title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="fon">

<div class="header">
    <h1> Instagram </h1>
</div>

<?php

set_time_limit(0);
date_default_timezone_set('UTC');

require __DIR__.'/vendor/autoload.php';
require_once "find_name.php";
require_once "classes/User_Info.php";
require_once "classes/Message_Info.php";

\InstagramAPI\Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;

$ig = new \InstagramAPI\Instagram();

$ig = new \InstagramAPI\Instagram(false, false);

try {
    $ig->login($_SESSION['username'], $_SESSION['password']);

    $info = $ig->direct->getInbox();
    $user = json_decode($info);

    $thread_user = $ig->direct->getThread($_POST['button']);

    $all_message = json_decode($thread_user);

    ?>

    <div class="titlepage">
        <h2> Диалог:&nbsp <h2 style="color: blueviolet" > <?php echo $all_message->thread->thread_title ?> </h2> </h2>
    </div>

<?php

global $count_message, $message_sender, $message;

$count_message = 0;
$count_users = 0;

foreach ($all_message->thread->users as $users_name) {
    $message_sender[$count_users] = new User_Info($users_name->pk, $users_name->username, $users_name->full_name);
    $count_users++;
}

$message_sender[$count_users] = new User_Info($user->viewer->pk, $user->viewer->username, $user->viewer->full_name);

foreach ($all_message->thread->items as $thread_info) {
    switch ($thread_info->item_type) {
        case 'text':
            $message[$count_message][] = new Message_Info($thread_info->item_type,0, $thread_info->text, $thread_info->user_id);
            break;
        case 'media':
            switch ($thread_info->media->media_type){
                case 1:
                    $message[$count_message][] = new Message_Info($thread_info->item_type, $thread_info->media->media_type, $thread_info->media->image_versions2->candidates[0]->url, $thread_info->user_id);
                    break;
                case 2:
                    $message[$count_message][] = new Message_Info($thread_info->item_type, $thread_info->media->media_type, $thread_info->media->video_versions[0]->url, $thread_info->user_id);
                    break;
            }
            break;
        case 'raven_media':
            switch ($thread_info->visual_media->media->media_type){
                case 1:
                    $message[$count_message][] = new Message_Info($thread_info->item_type, $thread_info->visual_media->media->media_type, 'В текущей версии просмотр недоступен!' /*$thread_info->visual_media->media->image_versions2->candidates[0]->url*/, $thread_info->user_id);
                    break;
                case 2:
                    $message[$count_message][] = new Message_Info($thread_info->item_type, $thread_info->visual_media->media->media_type, 'В текущей версии просмотр недоступен!' /*$thread_info->visual_media->media->video_versions[0]->url*/, $thread_info->user_id);
                    break;
            }
            break;
        case 'voice_media':
            $message[$count_message][] = new Message_Info($thread_info->item_type,0, $thread_info->voice_media->media->audio->audio_src, $thread_info->user_id);
            break;
        case 'like':
            $message[$count_message][] = new Message_Info($thread_info->item_type,0, 'В текущей версии просмотр недоступен!'/*$thread_info->like*/, $thread_info->user_id);
            break;
        case 'media_share':
            switch ($thread_info->media_share->media_type){
                case 1:
                    $message[$count_message][] = new Message_Info($thread_info->item_type, $thread_info->media_share->media_type, $thread_info->media_share->image_versions2->candidates[0]->url, $thread_info->user_id);
                    break;
                case 2:
                    $message[$count_message][] = new Message_Info($thread_info->item_type, $thread_info->media_share->media_type, $thread_info->media_share->video_versions[0]->url, $thread_info->user_id);
                    break;
                case 8:
                    $count_image = 0;
                    foreach ($thread_info->media_share->carousel_media as $carousel){
                        $message[$count_message][$count_image] = new Message_Info($thread_info->item_type, $thread_info->media_share->media_type, $carousel->image_versions2->candidates[0]->url, $thread_info->user_id);
                        $count_image++;
                    }
                    break;
            }
            break;
        case 'link':
            $message[$count_message][] = new Message_Info($thread_info->item_type,0, $thread_info->link->text, $thread_info->user_id);
            break;
        case 'video_call_event':
            $message[$count_message][] = new Message_Info($thread_info->item_type,0, $thread_info->video_call_event->description, $thread_info->user_id);
            break;
        case 'animated_media':
            $message[$count_message][] = new Message_Info($thread_info->item_type,0, $thread_info->animated_media->images->fixed_height->url, $thread_info->user_id);
            break;
        case 'action_log':
            $message[$count_message][] = new Message_Info($thread_info->item_type,0, $thread_info->action_log->description, $thread_info->user_id);
            break;
        case 'reel_share':
            $message[$count_message][] = new Message_Info($thread_info->item_type,0, 'В текущей версии просмотр недоступен!' /*$thread_info->reel_share->text'*/, $thread_info->user_id);
            break;
        default:
            $message[$count_message][] = new Message_Info($thread_info->item_type,0, 'В текущей версии просмотр недоступен!' /*$thread_info->reel_share->text'*/, $thread_info->user_id);
            break;
    }

    if ($count_message > 9){
        break;
    } else {
        $count_message++;
    }
}

find_name_thread($message, $message_sender);

?>

    <div id="divTable">

    </div>

    <script type="text/javascript">
        let session_name = '<?php echo $_SESSION['username']; ?>';
        let count_dialog = <?php echo count($message); ?>;
        let message_type = [];
        let message_media_type = [];
        let message = [];
        let message_sender_name = [];

        <?php for ($i = 0; $i < count($message); $i++){ ?>
        message[<?php echo $i ?>] = [];
        <?php for ($j = 0; $j < count($message[$i]); $j++) { ?>
        message_type[<?php echo $i ?>] = '<?php echo $message[$i][$j]->message_type; ?>';
        message_media_type[<?php echo $i ?>] = '<?php echo $message[$i][$j]->message_media_type; ?>';
        message[<?php echo $i ?>][<?php echo $j ?>] = '<?php echo $message[$i][$j]->message; ?>';
        message_sender_name[<?php echo $i ?>] = '<?php echo $message[$i][$j]->message_sender_name; ?>';
        <?php }
        } ?>
    </script>

    <script type="text/javascript" defer src="scripts/createThread.js"> </script>
    <!-- <script defer src="scripts/carousel.js"> </script> -->

    <?php
} catch (\Exception $e) {
    echo 'Something went wrong: '.$e->getMessage()."\n";
    exit(0);
}
?>

</body>
</html>
