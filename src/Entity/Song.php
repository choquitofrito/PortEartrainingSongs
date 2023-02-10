<?php

namespace App\Entity;

use App\Repository\SongRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SongRepository::class)]
class Song
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(nullable: true)]
    private ?int $originalTempo = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $originalTonality = null;

    #[ORM\ManyToOne(inversedBy: 'songs')]
    private ?Library $library = null;

    #[ORM\OneToMany(mappedBy: 'song', targetEntity: StudyStatus::class, cascade:['persist', 'remove'])]
    private Collection $studyStatuses;

    public function __construct($init = [])
    {
        $this->hydrate($init);
        $this->studyStatuses = new ArrayCollection();
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getOriginalTempo(): ?int
    {
        return $this->originalTempo;
    }

    public function setOriginalTempo(?int $originalTempo): self
    {
        $this->originalTempo = $originalTempo;

        return $this;
    }

    public function getOriginalTonality(): ?string
    {
        return $this->originalTonality;
    }

    public function setOriginalTonality(?string $originalTonality): self
    {
        $this->originalTonality = $originalTonality;

        return $this;
    }

    public function getLibrary(): ?Library
    {
        return $this->library;
    }

    public function setLibrary(?Library $library): self
    {
        $this->library = $library;

        return $this;
    }

    /**
     * @return Collection<int, StudyStatus>
     */
    public function getStudyStatuses(): Collection
    {
        return $this->studyStatuses;
    }

    public function addStudyStatus(StudyStatus $studyStatus): self
    {
        if (!$this->studyStatuses->contains($studyStatus)) {
            $this->studyStatuses->add($studyStatus);
            $studyStatus->setSong($this);
        }

        return $this;
    }

    public function removeStudyStatus(StudyStatus $studyStatus): self
    {
        if ($this->studyStatuses->removeElement($studyStatus)) {
            // set the owning side to null (unless already changed)
            if ($studyStatus->getSong() === $this) {
                $studyStatus->setSong(null);
            }
        }

        return $this;
    }
}
