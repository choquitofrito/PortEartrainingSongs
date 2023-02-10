<?php

namespace App\Controller;

use App\Entity\Library;
use App\Repository\LibraryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LibraryController extends AbstractController
{

    private ManagerRegistry $doctrine;
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;        
    }
    #[Route('/library/show/all', name: 'library_show_all')]
    public function showAll(LibraryRepository $rep): Response
    {
        return $this->render('library/show_all.html.twig', ['libraries'=> $rep->findAll()]);
    }

    #[Route('/library/show/songs/{id}', name: 'library_show_songs')]
    public function showSongs(Library $library): Response
    {
        return $this->render('library/show_songs.html.twig', ['librarySongs'=> $library->getSongs()]);
    }


}
