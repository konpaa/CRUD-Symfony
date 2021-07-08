<?php

namespace App\Services;

use App\Dto\Transformer\ArticleDtoTransformer;
use App\Dto\Transformer\UserDtoTransformer;
use App\Entity\Article;
use Symfony\Bridge\Twig\Mime\NotificationEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class MailerSendServices
 * @package App\Services
 */
class MailerSendServices
{
    /**
     * @var string $adminEmail
     */
    private string $adminEmail;

    /**
     * @var MailerInterface $mailer
     */
    private MailerInterface $mailer;

    /**
     * @var UserDtoTransformer
     */
    private UserDtoTransformer $userDtoTransformer;

    /**
     * @var ArticleDtoTransformer
     */
    private ArticleDtoTransformer $articleDtoTransformer;

    /**
     * MailerSendServices constructor.
     * @param string $adminEmail
     * @param MailerInterface $mailer
     * @param UserDtoTransformer $userDtoTransformer
     * @param ArticleDtoTransformer $articleDtoTransformer
     */
    public function __construct(
        string $adminEmail,
        MailerInterface $mailer,
        UserDtoTransformer $userDtoTransformer,
        ArticleDtoTransformer $articleDtoTransformer
    ) {
        $this->adminEmail = $adminEmail;
        $this->mailer = $mailer;
        $this->userDtoTransformer = $userDtoTransformer;
        $this->articleDtoTransformer = $articleDtoTransformer;
    }

    /**
     * @param Article $article
     * @param UserInterface $user
     * @throws TransportExceptionInterface
     */
    public function sendCreatedArticle(Article $article, UserInterface $user)
    {
        $dtoArticle = $this->articleDtoTransformer->transformFromObject($article);
        $dtoUser = $this->userDtoTransformer->transformFromObject($user);
        $this->mailer->send(
            (new NotificationEmail())
            ->subject('new article')
            ->htmlTemplate('email/letterForm.html.twig')
            ->from($dtoUser->email)
            ->to($this->adminEmail)
            ->context([
                'user' => $dtoUser,
                'article' => $dtoArticle
            ])
            ->sender($this->adminEmail)
        );
    }
}
