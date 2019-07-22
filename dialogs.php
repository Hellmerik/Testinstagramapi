<?php session_start(); ?>

<!DOCTYPE html>

<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title> Список диалогов </title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="fon">

<div class="header">
    <h1> Instagram </h1>
</div>

<?php

$username = $_POST['Log'];
$password = $_POST['Pas'];

set_time_limit(0);
date_default_timezone_set('UTC');

require __DIR__.'/vendor/autoload.php';

require_once "classes/User_Info.php";
require_once "classes/Message_Info.php";
require_once "classes/Thread_Info.php";
require_once "find_name.php";

\InstagramAPI\Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;

$ig = new \InstagramAPI\Instagram();

$ig = new \InstagramAPI\Instagram(false, false);

try {
    $ig->login($username, $password);

    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;

    ?>

    <div class="titlepage">
        <h2> Вы авторизировались под логином:&nbsp <h2 style="color: blueviolet"> <?php echo $_SESSION['username'] ?> </h2> </h2>
    </div>

    <?php

    $info = $ig->direct->getInbox();
    $user = json_decode($info);

    global $dialog_message, $count_dialog, $dialog_users;

    $count_dialog = 0;

    foreach ($user->inbox->threads as $dialog){
        foreach ($dialog->users as $name_id) {
            $dialog_users[$count_dialog][] = new User_Info($name_id->pk, $name_id->username, $name_id->full_name);
                switch ($dialog->last_permanent_item->item_type) {
                    case 'text':
                        $dialog_message[$count_dialog] = new Thread_Info($dialog->thread_id, $dialog->thread_title, $dialog->last_permanent_item->item_type, 0, $dialog->last_permanent_item->text, $dialog->last_permanent_item->user_id);
                        break;
                    case 'media':
                        switch ($dialog->last_permanent_item->media->media_type){
                            case 1:
                                $dialog_message[$count_dialog] = new Thread_Info($dialog->thread_id, $dialog->thread_title, $dialog->last_permanent_item->item_type, $dialog->last_permanent_item->media->media_type, $dialog->last_permanent_item->media->image_versions2->candidates[0]->url, $dialog->last_permanent_item->user_id);
                                break;
                            case 2:
                                $dialog_message[$count_dialog] = new Thread_Info($dialog->thread_id, $dialog->thread_title, $dialog->last_permanent_item->item_type, $dialog->last_permanent_item->media->media_type, $dialog->last_permanent_item->media->video_versions[0]->url, $dialog->last_permanent_item->user_id);
                                break;
                        }
                        break;
                    case 'raven_media':
                        switch ($dialog->last_permanent_item->visual_media->media->media_type){
                            case 1:
                                $dialog_message[$count_dialog] = new Thread_Info($dialog->thread_id, $dialog->thread_title, $dialog->last_permanent_item->item_type, $dialog->last_permanent_item->visual_media->media->media_type, 'В текущей версии просмотр недоступен!' /*$dialog->last_permanent_item->visual_media->media->image_versions2->candidates[0]->url*/, $dialog->last_permanent_item->user_id);
                                break;
                            case 2:
                                $dialog_message[$count_dialog] = new Thread_Info($dialog->thread_id, $dialog->thread_title, $dialog->last_permanent_item->item_type, $dialog->last_permanent_item->visual_media->media->media_type, 'В текущей версии просмотр недоступен!' /*$dialog->last_permanent_item->visual_media->media->video_versions[0]->url*/, $dialog->last_permanent_item->user_id);
                                break;
                        }
                        break;
                    case 'voice_media':
                        $dialog_message[$count_dialog] = new Thread_Info($dialog->thread_id, $dialog->thread_title, $dialog->last_permanent_item->item_type, 0, $dialog->last_permanent_item->voice_media->media->audio->audio_src, $dialog->last_permanent_item->user_id);
                        break;
                    case 'like':
                        $dialog_message[$count_dialog] = new Thread_Info($dialog->thread_id, $dialog->thread_title, $dialog->last_permanent_item->item_type, 0, 'В текущей версии просмотр недоступен!' /*$dialog->last_permanent_item->like*/, $dialog->last_permanent_item->user_id);
                        break;
                    case 'media_share':
                        switch ($dialog->last_permanent_item->media_share->media_type) {
                            case 1:
                                $dialog_message[$count_dialog] = new Thread_Info($dialog->thread_id, $dialog->thread_title, $dialog->last_permanent_item->item_type, $dialog->last_permanent_item->media_share->media_type, $dialog->last_permanent_item->media_share->image_versions2->candidates[0]->url, $dialog->last_permanent_item->user_id);
                                break;
                            case 2:
                                $dialog_message[$count_dialog] = new Thread_Info($dialog->thread_id, $dialog->thread_title, $dialog->last_permanent_item->item_type, $dialog->last_permanent_item->media_share->media_type, $dialog->last_permanent_item->media_share->video_versions[0]->url, $dialog->last_permanent_item->user_id);
                                break;
                            case 8:
                                $dialog_message[$count_dialog] = new Thread_Info($dialog->thread_id, $dialog->thread_title, $dialog->last_permanent_item->item_type, $dialog->last_permanent_item->media_share->media_type, 'В текущей версии просмотр недоступен!', $dialog->last_permanent_item->user_id);
                                 $count_image = 0;
                                foreach ($dialog->last_permanent_item->media_share->carousel_media as $carousel){
                                    $dialog_message[$count_dialog][$count_image] = new Message_Info($dialog->thread_id, $dialog->thread_title, $carousel->image_versions2->candidates[0]->url, $dialog->last_permanent_item->user_id);
                                    $count_image = 0;
                                }
                                break;
                        }
                        break;
                    case 'link':
                        $dialog_message[$count_dialog] = new Thread_Info($dialog->thread_id, $dialog->thread_title, $dialog->last_permanent_item->item_type, 0, $dialog->last_permanent_item->link->text, $dialog->last_permanent_item->user_id);
                        break;
                    case 'video_call_event':
                        $dialog_message[$count_dialog] = new Thread_Info($dialog->thread_id, $dialog->thread_title, $dialog->last_permanent_item->item_type, 0, $dialog->last_permanent_item->video_call_event->description, $dialog->last_permanent_item->user_id);
                        break;
                    case 'animated_media':
                        $dialog_message[$count_dialog] = new Thread_Info($dialog->thread_id, $dialog->thread_title, $dialog->last_permanent_item->item_type, 0, $dialog->last_permanent_item->animated_media->images->fixed_height->url, $dialog->last_permanent_item->user_id);
                        break;
                    case 'action_log':
                        $dialog_message[$count_dialog] = new Thread_Info($dialog->thread_id, $dialog->thread_title, $dialog->last_permanent_item->item_type, 0, $dialog->last_permanent_item->action_log->description, $dialog->last_permanent_item->user_id);
                        break;
                    case 'reel_share':
                        $dialog_message[$count_dialog] = new Thread_Info($dialog->thread_id, $dialog->thread_title, $dialog->last_permanent_item->item_type, 0, "В текущей версии просмотр недоступен!", $dialog->last_permanent_item->user_id);
                        break;
                    default:
                        $dialog_message[$count_dialog] = new Thread_Info($dialog->thread_id, $dialog->thread_title, $dialog->last_permanent_item->item_type, 0, "В текущей версии просмотр недоступен!", $dialog->last_permanent_item->user_id);
                        break;
                }
        }

        $dialog_users[$count_dialog][] = new User_Info($user->viewer->pk, $user->viewer->username, $user->viewer->full_name);

        if ($count_dialog > 9) {
            break;
        } else {
            $count_dialog++;
        }
    }

    if (($dialog_message > 0) && ($dialog_users > 0)){
        find_name_dialogs($dialog_message, $dialog_users);
    } else {
        ?> <h3 align="center"> Диалогов нет </h3> <?php
    }


    ?>

    <div id="divTable">

    </div>

    <script type="text/javascript">
        let count_dialog = <?php echo count($dialog_message); ?>;
        let thread_id = [];
        let thread_title = [];
        let message_type = [];
        let message_media_type = [];
        let message = [];
        let message_sender_name = [];

        <?php for ($i = 0; $i < count($dialog_message); $i++){ ?>
        thread_id[<?php echo $i ?>] = '<?php echo $dialog_message[$i]->thread_id; ?>';
        thread_title[<?php echo $i ?>] = '<?php echo $dialog_message[$i]->thread_title; ?>';
        message_type[<?php echo $i ?>] = '<?php echo $dialog_message[$i]->message_type; ?>';
        message_media_type[<?php echo $i ?>] = '<?php echo $dialog_message[$i]->message_media_type; ?>';
        message[<?php echo $i ?>] = '<?php echo $dialog_message[$i]->message; ?>';
        message_sender_name[<?php echo $i ?>] = '<?php echo $dialog_message[$i]->message_sender_name; ?>';
        <?php } ?>

    </script>

    <script type="text/javascript" defer src="scripts/createTable.js"> </script>

    <?php
} catch (\Exception $e) {
    echo 'Something went wrong: '.$e->getMessage()."\n";
    exit(0);
}
?>

</body>
</html>