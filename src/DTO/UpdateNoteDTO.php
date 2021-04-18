<?php

namespace App\DTO;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateNoteDTO implements RequestDTOInterface
{
    #[Assert\Type(
        type: 'string',
        message: 'The value {{ value }} is not a valid {{ type }}.',
    )]
    #[Assert\NotBlank]
    private $title;

    #[Assert\Type(
        type: 'string',
        message: 'The value {{ value }} is not a valid {{ type }}.',
    )]
    private $body;

    public function __construct(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $this->title = $data['title'] ?? '';
        $this->body = $data['body'] ?? '';
    }

    public function title(): string
    {
        return $this->title;
    }

    public function body(): string
    {
        return $this->body;
    }
}
