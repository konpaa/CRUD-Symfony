<?php

namespace App\Tests\UnitTest;

use App\Entity\Article;
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $user;

    private Article $firstArticle;

    private Article $secondArticle;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = new User();
        $this->user->setName('Pavel');
        $this->user->setEmail('example@google.com');
        $this->user->setPassword('password');

        $this->firstArticle = new Article();
        $this->firstArticle->setName('FirstTitle');
        $this->firstArticle->setBody('nullam eget felis eget nunc');

        $this->secondArticle = new Article();
        $this->secondArticle->setName('SecondTitle');
        $this->secondArticle->setBody('feugiat in ante metus dictum');
    }

    public function testGetterSetterName(): void
    {
        $this->assertEquals('Pavel', $this->user->getName());
        $this->user->setName('User');
        $this->assertEquals('User', $this->user->getName());
    }

    public function testGetterSetterEmail(): void
    {
        $this->assertEquals('example@google.com', $this->user->getEmail());
        $this->user->setEmail('User@mail.ru');
        $this->assertEquals('User@mail.ru', $this->user->getEmail());
    }

    public function testGetterSetterPassword(): void
    {
        $this->assertEquals('password', $this->user->getPassword());
        $this->user->setPassword('user');
        $this->assertEquals('user', $this->user->getPassword());
    }

    public function testGetterSetterDate(): void
    {
        $this->user->setCreatedAt(new DateTime());
        $date = new DateTime();
        $this->assertEquals($date->format('D'), $this->user->getCreatedAt()->format('D'));
    }

    public function testAddArticles(): void
    {
        $this->user->addArticle($this->firstArticle);
        $this->assertCount(1, $this->user->getArticles());
        $this->user->addArticle($this->secondArticle);
        $this->assertCount(2, $this->user->getArticles());
    }

    public function testRemoveArticles(): void
    {
        $this->user->addArticle($this->firstArticle);
        $this->assertCount(1, $this->user->getArticles());
        $this->user->addArticle($this->secondArticle);
        $this->assertCount(2, $this->user->getArticles());
        $this->user->removeArticle($this->firstArticle);
        $this->assertCount(1, $this->user->getArticles());
        $this->user->removeArticle($this->secondArticle);
        $this->assertCount(0, $this->user->getArticles());
    }
}
