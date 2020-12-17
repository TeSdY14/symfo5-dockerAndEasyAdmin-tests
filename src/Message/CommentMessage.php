<?php

namespace App\Message;

class CommentMessage
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var array
     */
    private $context;
    /**
     * @var string
     */
    private $reviewUrl;

    public function __construct(int $id, string $reviewUrl, array $context = [])
    {
        $this->id = $id;
        $this->context = $context;
        $this->reviewUrl = $reviewUrl;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getContext(): array
    {
        return $this->context;
    }

    /**
     * @return string
     */
    public function getReviewUrl(): string
    {
        return $this->reviewUrl;
    }
}
