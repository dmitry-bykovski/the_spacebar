<?php


namespace App\Controller;

use App\Entity\Article;
use App\Service\SiteUpdateManager;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\MarkdownHelper;
use App\Service\MessageGenerator;
use Symfony\Component\HttpFoundation\Response;
use App\Service\SlackClient;

class ArticleController extends AbstractController
{
	public function __construct(bool $isDebug)
	{
		$this->isDebug = $isDebug;
	}

	/**
	 * @Route("/", name="app_homepage")
	 */
	public function homepage(){
		return $this->render('article/homepage.html.twig');
	}
//Аннотации
	/**
	 * @Route("/news/{slug}", name="article_show")
	 */

	public function show($slug, SlackClient $slack, EntityManagerInterface $em)
	{
		$comments = [
			'I ate a normal rock once. It did NOT taste like bacon!',
			'Woohoo! I\'m going on an all-asteroid diet!',
			'I like bacon too! Buy some from my site! bakinsomebacon.com',
		];

		if ($slug === 'khaaan') {
			$slack->sendMessage('Boo-ga-ga', 'Hello WTF');
		}

		$repository = $em->getRepository(Article::class);
		/** @var Article $article */
		$article = $repository->findOneBy(['slug' => $slug]);
		if (!$article){
			throw $this->createNotFoundException(sprintf('No article for slug "%s"', $slug));
		}

//		dump($article);die;
		return $this->render('article/show.html.twig', [
			'article' => $article,
			'comments' => $comments
		]);
	}

	/**
	 * @Route ("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
	 */
	public function toggleArticleHeart($slug, LoggerInterface $logger)
	{
		$logger->info('Article is being hearted');
//		dump($slug, $this);
		//TODO - actually heart/unheart the article!
		return $this->json(['hearts' => rand(5, 100)]);
	}

	/**
	 * @Route ("/test_service")
	 */
	public function list(LoggerInterface $logger): Response
	{
		$logger->info('Look, I just used a service!');
		return new Response('Hello');
	}

	/**
	 * @Route ("/test_service/new")
	 */
	public function happyMessage(MessageGenerator $messageGenerator): Response
	{
		// thanks to the type-hint, the container will instantiate a
		// new MessageGenerator and pass it to you!
		// ...

		$message = $messageGenerator->getHappyMessage();
		$this->addFlash('seccess', $message);
		return new Response($message);
	}

	/**
	 * @Route ("/send_email")
	 */
	public function emailSend(SiteUpdateManager $siteUpdateManager)
	{

		if ($siteUpdateManager->notifyOfSiteUpdate()) {
			$this->addFlash('success', 'Notification mail was sent successfully.');
		}
		return new Response('email_send');
	}
}
