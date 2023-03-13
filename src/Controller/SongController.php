<?php

namespace App\Controller;

use App\Entity\Song;
use App\Form\SongType;
use App\Service\UploadHelper;
use App\Repository\StudyStatusRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class SongController extends AbstractController
{


    #[Route("/song/new")]
    public function newSong(Request $request, ManagerRegistry $doctrine, UploadHelper $uploader)
    {
        $song = new Song();
        $songForm = $this->createForm(SongType::class, $song);
        $songForm->handleRequest($request);
        if ($songForm->isSubmitted() && $songForm->isValid()) {
            $file = $songForm['fileLink']->getData();
            if ($file) {
                $nomfileServeur = $uploader->upload($file);
                $song->setFileLink($nomfileServeur);
            }
            $em = $doctrine->getManager();
            $em->persist($song);
            $em->flush();
            return new Response("new song uploaded");
        } else {
            return $this->render(
                "/song/new_song.html.twig",
                ['form' => $songForm->createView()]
            );
        }
    }

    #[Route('/song/show/study/statuses/{id}', name: 'show_study_statuses')]
    public function showStudyStatuses(Song $song, StudyStatusRepository $rep): Response
    {

        // get status for current User and chosen Song
        $studyStatus = $rep->findOneBy([
            'user' => $this->getUser()->getId(),
            'song' => $song->getId()
        ]);


        return $this->render(
            'song/show_study_statuses.html.twig',
            [
                'studyStatus' => $studyStatus,
                // 'fileLink'=> $this->getParameter('kernel.project_dir'). "\\public\\audiosUpload\\" . $song->getFileLink() ]
                'fileLink' => '/audiosUpload/' . $song->getFileLink()
            ]
        );
    }

    #[Route('/song/study/status/save')]
    public function showStudyStatusSave(Request $req, StudyStatusRepository $rep)
    {

        $songId = $req->request->get("idSong");
        $tonality = $req->request->get("tonality");
        $tempo = $req->request->get("tempo");

        $userId = $this->getUser()->getId();
        $studyStatus = $rep->findOneBy([
            "song" => $songId,
            "user" => $userId
        ]);

        $vals = $studyStatus->getTempoTonality();
        $vals[$tonality] = $tempo;
        $studyStatus->setTempoTonality($vals);
        // dd($studyStatus);
        return new JsonResponse(['status' => 'Recorded']);
    }
}
