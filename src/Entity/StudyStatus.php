<?php

namespace App\Entity;

use App\Repository\StudyStatusRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudyStatusRepository::class)]
class StudyStatus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private array $tempoTonality = [];

    #[ORM\ManyToOne(inversedBy: 'studyStatuses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Song $song = null;

    #[ORM\ManyToOne(inversedBy: 'studyStatuses')]
    private ?User $user = null;


    public function __construct($init = [])
    {
        $this->hydrate($init);
    }

    // hydrate
    public function hydrate(array $init)
    {
        foreach ($init as $key => $value) {
            $method = "set" . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTempoTonality(): array
    {
        return $this->tempoTonality;
    }

    public function setTempoTonality(?array $tempoTonality): self
    {
        $this->tempoTonality = $tempoTonality;

        return $this;
    }

    public function getSong(): ?Song
    {
        return $this->song;
    }

    public function setSong(?Song $song): self
    {
        $this->song = $song;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
