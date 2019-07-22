<?php

class Thread_Info extends Message_Info {
    public $thread_id;
    public $thread_title;

    public function __construct($thread_id, $thread_title, $message_type, $message_media_type, $message, $message_sender_id){
        parent::__construct( $message_type, $message_media_type, $message, $message_sender_id);

        $this->thread_id = $thread_id;
        $this->thread_title = $thread_title;
    }

    public function __destruct(){
        // TODO: Implement __destruct() method.
    }
}