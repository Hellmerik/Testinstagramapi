<?php

function find_name_dialogs($id, $name){
    for ($i = 0; $i < count($id); $i++) {
        for ($j = 0; $j < count($name[$i]); $j++) {
            if ($id[$i]->message_sender_id == $name[$i][$j]->username_id){
                $id[$i]->message_sender_name = $name[$i][$j]->username;
            }
        }
    }
}

function find_name_thread($id, $name){
    for ($i = 0; $i < count($id); $i++){
        for ($j = 0; $j < count($id[$i]); $j++){
            for ($k = 0; $k < count($name); $k++){
                if ($id[$i][$j]->message_sender_id == $name[$k]->username_id){
                    $id[$i][$j]->message_sender_name = $name[$k]->username;
                }
            }
        }
    }
}