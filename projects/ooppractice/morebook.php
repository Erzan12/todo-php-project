<?php

class Book {
    public $title;
    public $author;
    public $year;

    public function __construct($title,$author,$year) {
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;

        if ($year > date("Y")) {
            echo "The book is from the Future! 🤯<br>";
        }
    }

    public function getSummary() {
        return "Title: {$this->title}, Author: {$this->author}, Year: {$this->year}";
    }
}
$book = new Book("Twilight", "Stephenie Meyer", 2026);
echo $book->getSummary();