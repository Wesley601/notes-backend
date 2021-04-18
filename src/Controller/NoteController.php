<?php

namespace App\Controller;

use App\DTO\UpdateNoteDTO;
use App\Repository\NoteRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/notes', name: 'note_')]
class NoteController
{
    public function __construct(
        private NoteRepository $noteRepository,
    ) {}

    #[Route('/', name: 'index', methods:['GET'])]
    public function index(): Response
    {
        $notes = $this->noteRepository->findAll();
        $data = [];

        foreach ($notes as $note) {
            $data[] = $note->toArray();
        }

        return new JsonResponse($data);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(int $id): Response
    {
        $data = $this->noteRepository->findOneBy(['id' => $id]);

        if (is_null($data)) {
            return new JsonResponse(['status' => 'note not found'], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($data->toArray());
    }

    #[Route('/', name: 'store', methods:['POST'])]
    public function store(Request $request): Response
    {
        $data = json_decode($request->getContent());

        $title = $data->title;
        $body = $data->body;

        $note = $this->noteRepository->saveNote($title, $body);

        return new JsonResponse(data: $note->toArray(), status: Response::HTTP_CREATED);
    }

    #[Route('/{id}', name: 'update', methods: ['PUT'])]
    public function update(int $id, UpdateNoteDTO $updateNoteDTO): JsonResponse
    {
        $noteToUpdate = $this->noteRepository->findOneBy(['id' => $id]);

        $updatedNote = $this->noteRepository->updateNote($noteToUpdate, $updateNoteDTO);

        return new JsonResponse($updatedNote->toArray());
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete($id): JsonResponse
    {
        $note = $this->noteRepository->findOneBy(['id' => $id]);

        $this->noteRepository->removeNote($note);

        return new JsonResponse(['status' => 'Customer deleted'], Response::HTTP_NO_CONTENT);
    }

}
