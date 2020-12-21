<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="tasks")
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 */
class Task
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hours;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $priority;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $completed;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $delivery_date;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @var DateTime|null
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="tasks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * Task constructor.
     * @param $completed
     */
    public function __construct()
    {
        $this->completed = 'NO';
    }


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getHours(): ?int
    {
        return $this->hours;
    }

    /**
     * @param int|null $hours
     * @return $this
     */
    public function setHours(?int $hours): self
    {
        $this->hours = $hours;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPriority(): ?string
    {
        return $this->priority;
    }

    /**
     * @param string $priority
     * @return $this
     */
    public function setPriority(string $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCompleted(): ?string
    {
        return $this->completed;
    }

    /**
     * @param string $completed
     * @return $this
     */
    public function setCompleted(string $completed): self
    {
        $this->completed = $completed;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDeliveryDate(): ?DateTimeInterface
    {
        return $this->delivery_date;
    }

    /**
     * @param DateTimeInterface|null $delivery_date
     * @return $this
     */
    public function setDeliveryDate(?DateTimeInterface $delivery_date): self
    {
        $this->delivery_date = $delivery_date;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->created_at;
    }

    /**
     * @param DateTimeInterface $created_at
     * @return $this
     */
    public function setCreatedAt(DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updated_at;
    }

    /**
     * @param DateTimeInterface|null $updated_at
     * @return $this
     */
    public function setUpdatedAt(?DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     * @return $this
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
