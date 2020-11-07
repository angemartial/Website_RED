<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url()
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min = 10, max = 255, minMessage = "Votre caption doit faire au moins 10 caractères")
     */
    private $caption;

    /**
     * @ORM\OneToMany(targetEntity=AboutUs::class, mappedBy="aboutImage")
     */
    private $aboutUs;

    public function __construct()
    {
        $this->aboutUs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * @return Collection|AboutUs[]
     */
    public function getAboutUs(): Collection
    {
        return $this->aboutUs;
    }

    public function addAboutUs(AboutUs $aboutUs): self
    {
        if (!$this->aboutUs->contains($aboutUs)) {
            $this->aboutUs[] = $aboutUs;
            $aboutUs->setAboutImage($this);
        }

        return $this;
    }

    public function removeAboutUs(AboutUs $aboutUs): self
    {
        if ($this->aboutUs->removeElement($aboutUs)) {
            // set the owning side to null (unless already changed)
            if ($aboutUs->getAboutImage() === $this) {
                $aboutUs->setAboutImage(null);
            }
        }

        return $this;
    }
}
