<?php

namespace App\Entity;

use App\Repository\BlogPostRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BlogPostRepository::class)
 */
class BlogPost
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
	private $body;

	/**
	 * @var bool
	 *
	 * @ORM\Column(name="draft", type="boolean")
	 */
	private $draft = false;

	/**
	 * @ORM\ManyToOne(targetEntity="Category", inversedBy="blogPosts")
	 */
	private $category;

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

	/**
	 * @return mixed
	 */
	public function getBody()
	{
		return $this->body;
	}

	/**
	 * @param mixed $body
	 */
	public function setBody($body): void
	{
		$this->body = $body;
	}

	/**
	 * @return bool
	 */
	public function isDraft(): bool
	{
		return $this->draft;
	}

	/**
	 * @param bool $draft
	 */
	public function setDraft(bool $draft): void
	{
		$this->draft = $draft;
	}

	/**
	 * @return mixed
	 */
	public function getCategory()
	{
		return $this->category;
	}

	/**
	 * @param mixed $category
	 */
	public function setCategory($category): void
	{
		$this->category = $category;
	}

}
