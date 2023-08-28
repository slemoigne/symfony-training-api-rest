<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class BookController extends AbstractController
{
    #[Route('/api/books', name: 'books', methods: ['GET'])]
    public function getBookList(BookRepository $bookRepository, SerializerInterface $serializer): JsonResponse
    {
        $books = $bookRepository->findAll();

        return new JsonResponse(
            $serializer->serialize($books, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }

    /*#[Route('/api/books/{id}', name: 'books', methods: ['GET'])]
    public function get(int $id, BookRepository $bookRepository, SerializerInterface $serializer): JsonResponse
    {
        $book = $bookRepository->find($id);
        if ($book) {
            return new JsonResponse(
                $serializer->serialize($book, 'json'),
                Response::HTTP_OK,
                [],
                true
            );
        }

        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }*/

    #[Route('/api/books/{id}', name: 'books', methods: ['GET'])]
    public function get(Book $book, SerializerInterface $serializer): JsonResponse
    {
        return new JsonResponse(
            $serializer->serialize($book, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
