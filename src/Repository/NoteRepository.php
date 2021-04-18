<?php

namespace App\Repository;

use App\DTO\UpdateNoteDTO;
use App\Entity\Note;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Note|null find($id, $lockMode = null, $lockVersion = null)
 * @method Note|null findOneBy(array $criteria, array $orderBy = null)
 * @method Note[]    findAll()
 * @method Note[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteRepository extends ServiceEntityRepository
{
    public function __construct(
        private EntityManagerInterface $manager,
        ManagerRegistry $registry
    ) {
        parent::__construct($registry, Note::class);
    }

    public function saveNote(string $title, string $body): Note
    {
        $newNote = new Note();

        $newNote
            ->setTitle($title)
            ->setBody($body)
        ;

        $this->manager->persist($newNote);
        $this->manager->flush();

        return $newNote;
    }

    public function updateNote(Note $newNote, UpdateNoteDTO $updateNoteDTO): Note
    {
        $newNote
            ->setTitle($updateNoteDTO->title())
            ->setBody($updateNoteDTO->body());

        $this->manager->persist($newNote);
        $this->manager->flush();

        return $newNote;
    }

    public function removeNote(Note $newNote): Note
    {
        $this->manager->remove($newNote);
        $this->manager->flush();

        return $newNote;
    }
}
