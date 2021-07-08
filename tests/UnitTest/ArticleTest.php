<?php

namespace App\Tests\UnitTest;

use App\Entity\Article;
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;

/**
 * Class ArticleTest
 * @package App\Tests
 */
class ArticleTest extends TestCase
{
    /**
     * @var Article
     */
    private Article $article;

    /**
     * @var User
     */
    private User $user;

    /**
     * @var User
     */
    private User $newUser;

    /**
     *
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->article = new Article();
        $this->article->setName('Title');
        $this->article->setBody('nullam eget felis eget nunc');

        $this->user = new User();
        $this->user->setName('User');
        $this->user->setEmail('user@example.com');
        $this->user->setPassword('password');

        $this->newUser = new User();
        $this->newUser->setName('NewUser');
        $this->newUser->setEmail('new@mail.ru');
        $this->newUser->setPassword('newPassword');
    }

    /**
     *
     */
    public function testGetterSetterName(): void
    {
        $this->assertEquals('Title', $this->article->getName());
        $this->article->setName('New');
        $this->assertEquals('New', $this->article->getName());
    }

    /**
     *
     */
    public function testGetterSetterBody(): void
    {
        $this->assertEquals('nullam eget felis eget nunc', $this->article->getBody());
        $this->article->setBody('new body');
        $this->assertEquals('new body', $this->article->getBody());
    }

    /**
     *
     */
    public function testGetterSetterDate(): void
    {
        $this->article->setCreatedAt(new DateTime());
        $date = new DateTime();
        $this->assertEquals($date->format('D'), $this->article->getCreatedAt()->format('D'));
    }

    /**
     *
     */
    public function testAddCreator(): void
    {
        $this->article->setCreator($this->user);
        $this->assertEquals($this->user, $this->article->getCreator());
        $this->assertEquals('user@example.com', $this->article->getCreator()->getUserIdentifier());

        $this->article->setCreator($this->newUser);
        $this->assertEquals($this->newUser, $this->article->getCreator());
    }
}
