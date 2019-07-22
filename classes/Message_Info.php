<?php

class Message_Info{

    public $message_type;
    public $message_media_type;
    public $message;
    public $message_sender_id;
    public $message_sender_name;

    public function __construct($message_type, $message_media_type, $message, $message_sender_id){
        $this->message_type = $message_type;
        $this->message_media_type = $message_media_type;
        $this->message = $message;
        $this->message_sender_id = $message_sender_id;
    }

    public function __destruct(){
        // TODO: Implement __destruct() method.
    }
}