<?php

declare(strict_types = 1);

namespace Temirkhan\Blog\Service;

use Temirkhan\Blog\Entity\AuthorInterface;
use Temirkhan\Blog\Entity\PostInterface;
use Temirkhan\Blog\Filter\Page;
use Temirkhan\Blog\Filter\PostFilter;
use Temirkhan\Blog\Sort\PostSort;

/**
 * Интерфейс сервиса публикаций
 */
interface PostServiceInterface
{
    /**
     * Добавляет публикацию
     *
     * @param PostInterface $post
     *
     * @return PostInterface
     */
    public function addPost(PostInterface $post): PostInterface;

    /**
     * Возвращает список публикаций
     *
     * @param Page          $pageFilter
     * @param PostFilter    $filter
     * @param PostSort|null $postSort
     *
     * @return PostInterface[]
     */
    public function getPosts(Page $pageFilter, PostFilter $filter, PostSort $postSort = null): array;

    /**
     * Возвращает список публикаций автора
     *
     * @param AuthorInterface $author
     * @param Page            $pageFilter
     * @param PostFilter      $filter
     * @param PostSort|null   $postSort
     *
     * @return PostInterface[]
     */
    public function getAuthorPosts(
        AuthorInterface $author,
        Page $pageFilter,
        PostFilter $filter,
        PostSort $postSort = null
    ): array;

    /**
     * Возвращает количество публикаций
     *
     * @param PostFilter $filter
     *
     * @return int
     */
    public function getPostsCount(PostFilter $filter): int;

    /**
     * Возвращает количество публикаций автора
     *
     * @param AuthorInterface $author
     * @param PostFilter      $filter
     *
     * @return int
     */
    public function getAuthorPostsCount(AuthorInterface $author, PostFilter $filter): int;
}
