<?php

class Book {
    public $title;

    public function __construct($bookTitle) {
        $this->title = $bookTitle;
    }

    public function read() {
        return "You are reading" . $this->title;
    }
}

$book = new Book(" The Lord of the Rings");
echo $book->read();