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
    #[Route('/song/show/study/statuses/{id}', name: 'show_study_statuses')]
    public function showStudyStatuses(Song $song, StudyStatusRepository $rep): Response
    {

        // get statuses for current User

        $studyStatus = $rep->findOneBy([
            'user' => $this->getUser()->getId(),
            'song' => $song->getId()
        ]);


        return $this->render(
            'song/show_study_statuses.html.twig',
            ['studyStatus' => $studyStatus,
            // 'fileLink'=> $this->getParameter('kernel.project_dir'). "\\public\\audiosUpload\\" . $song->getFileLink() ]
            'fileLink'=> '/audiosUpload/' . $song->getFileLink() ]
        );
    }
}
