<?php

class Movie {
    public $name;
    public $genre;
    public $rating;

    public function __construct($name, $genre, $rating) {
        $this->name = $name;
        $this->genre = $genre;
        $this->rating = $rating;
    }
    public function getDetails() { 
        return "Movie: {$this->name}, Genre: {$this->genre}, Rating: {$this->rating}/10";
    }
    public function isRecommended() {
        if ($this->rating >= 7) {
            return " | Recommended! Great choice. 🍿<br>";
        } else {
            return " | Not recommended! Maybe skip this one...<br>";
        }
    }
}
$movie1 = new Movie("Inception", "Sci-Fi", 6);
$movie2 = new Movie("Titanic", "Romance", 10);

echo $movie1->getDetails();
echo $movie1->isRecommended();

echo $movie2->getDetails();
echo $movie2->isRecommended();