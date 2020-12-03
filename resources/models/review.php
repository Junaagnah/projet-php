<?php

class Review {
    private int $id;
    public int $FK_userId;
    public int $FK_movieId;
    public string $review;
    public int $note;

    public function __construct(array $review)
    {
        if (!empty($review['id']))
            $this->id = $review['id'];

        if (!empty($review['FK_userId']))
            $this->FK_userId = $review['FK_userId'];

        if (!empty($review['FK_movieId']))
            $this->FK_movieId = $review['FK_movieId'];

        if (!empty($review['review']))
            $this->review = $review['review'];

        if (!empty($review['note']))
            $this->note = $review['note'];
    }
}
