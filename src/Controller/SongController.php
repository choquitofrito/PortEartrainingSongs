<?php

namespace App\Controller;

use App\Entity\Song;
use App\Repository\StudyStatusRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SongController extends AbstractController
{
    #[Route('/song/show/study/statuses/{idSong}', name: 'show_study_statuses')]
    public function showStudyStatuses(int $idSong, StudyStatusRepository $rep): Response
    {

        // get statuses for current User

        $studyStatus = $rep->findOneBy([
            'user' => $this->getUser()->getId(),
            'song' => $idSong
        ]);


        return $this->render(
            'song/show_study_statuses.html.twig',
            ['studyStatus' => $studyStatus]
        );
    }
}
