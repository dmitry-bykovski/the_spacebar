<?php


namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Service\SiteUpdateManager;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\MessageGenerator;
use Symfony\Component\HttpFoundation\Response;
use App\Service\SlackClient;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ArticleController extends AbstractController
{
	public function __construct(bool $isDebug)
	{
		$this->isDebug = $isDebug;
	}

//Аннотации
	/**
	 * @Route("/", name="app_homepage")
	 */
	public function homepage(ArticleRepository $repository){

		$articles = $repository -> findAllPublishedOrderedByNewest();
//		dump($repository);die;

		return $this->render('article/homepage.html.twig', [
			'articles' => $articles,
		]);
	}

	/**
	 * @Route("/news/{slug}", name="article_show")
	 *
	 * @ParamConverter("article", options={"mapping": {"slug": "slug"}})
	 */
	public function show(SlackClient $slack, Article $article)
	{
//		$repository = $em->getRepository(Article::class);
//		$article = $repository->findOneBy(['slug' => $slug]);

		if ($article->getSlug() === 'khaaaaaan') {
			$slack->sendMessage('Kahn', 'Ah, Kirk, my old friend...');
		}

		$comments = [
			'I ate a normal rock once. It did NOT taste like bacon!',
			'Woohoo! I\'m going on an all-asteroid diet!',
			'I like bacon too! Buy some from my site! bakinsomebacon.com',
		];

		return $this->render('article/show.html.twig', [
			'article' => $article,
			'comments' => $comments,
		]);
	}

	/**
	 * @Route ("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
	 */
	public function toggleArticleHeart($slug, LoggerInterface $logger)
	{
		$logger->info('Article is being hearted');
//		dump($slug, $this);
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
