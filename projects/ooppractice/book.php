<?php

    class book { 
        public $title;

        public function read() {
            return "You are reading" . $this->title;
        }
    }
    $book = new book();
    $book->title = " Early JavaScript";
    echo $book->read();
    ?>