<?php

namespace BlogBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\OrderBy;

/**
 * Публикация
 *
 * @ORM\Table(name="post", indexes={@Index(name="author_id_index", columns={"author_id"})})
 */
class Post
{
    const STATUS_DRAFT     = 'draft';
    const STATUS_PUBLISHED = 'published';

    /**
     * Идентификатор
     *
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id = 0;

    /**
     * Автор
     *
     * @ManyToOne(targetEntity="Author")
     * @JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    /**
     * Заголовок
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title = '';

    /**
     * Краткая аннотация
     *
     * @ORM\Column(name="teaser", type="string", length=255)
     */
    private $teaser = '';

    /**
     * Текст публикации
     *
     * @ORM\Column(type="text", length=3000)
     */
    private $content = '';

    /**
     * Статус
     *
     * @ORM\Column(name="`status`", type="string", length=10)
     */
    private $status = self::STATUS_DRAFT;

    /**
     * Дата добавления
     *
     * @ORM\Column(name="add_date", type="datetime")
     */
    private $addDate;

    /**
     * Дата опубликования
     *
     * @ORM\Column(name="pub_date", type="datetime", nullable=true)
     */
    private $pubDate;

    /**
     * Комментарии
     *
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post")
     * @OrderBy({"pubDate"="DESC"})
     */
    private $comments;

    /**
     * Конструктор
     *
     * @param Author $author
     */
    public function __construct(Author $author)
    {
        $this->addDate  = new DateTime();
        $this->author   = $author;
        $this->comments = new ArrayCollection();
    }

    /**
     * Возвращает идентификатор
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * Устанавливает заголовок
     *
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Возвращает заголовок
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Устанавливает контект
     *
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Возвращает контект
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Указывает дату создания
     *
     * @param DateTime $addDate
     */
    public function setAddDate(DateTime $addDate)
    {
        $this->addDate = $addDate;
    }

    /**
     * Возвращает дату создания
     *
     * @return DateTime
     */
    public function getAddDate(): DateTime
    {
        return $this->addDate;
    }

    /**
     * Устанавливает дату опубликования
     *
     * @param DateTime $pubDate
     */
    public function setPubDate(DateTime $pubDate)
    {
        $this->pubDate = $pubDate;
    }

    /**
     * Возвращает дату опубликования
     *
     * @return null|DateTime
     */
    public function getPubDate()
    {
        return $this->pubDate;
    }

    /**
     * Устанавливает аннотацию
     *
     * @param string $teaser
     */
    public function setTeaser(string $teaser)
    {
        $this->teaser = $teaser;
    }

    /**
     * Возвращает аннотацию
     *
     * @return string
     */
    public function getTeaser(): string
    {
        return $this->teaser;
    }

    /**
     * Устанавливает статус
     *
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    /**
     * Возвращает статус
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Возвращает автора
     *
     * @return Author
     */
    public function getAuthor(): Author
    {
        return $this->author;
    }

    /**
     * Добавляет комментарий
     *
     * @param Comment $comment
     */
    public function addComment(Comment $comment)
    {
        $this->comments->add($comment);
    }

    /**
     * Удаляет комментарий
     *
     * @param Comment $comment
     */
    public function deleteComment(Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Возвращает комментарии
     *
     * @return Comment[]
     */
    public function getComments(): array
    {
        return $this->comments->toArray();
    }
}
