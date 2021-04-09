<?php


namespace App\Controller;

use App\Service\SiteUpdateManager;
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

	/**
	 * @Route("/news/{slug}", name="article_show")
	 */

	public function show($slug, MarkdownHelper $markdownHelper, SlackClient $slack)
	{
		$comments = [
			'I ate a normal rock once. It did NOT taste like bacon!',
			'Woohoo! I\'m going on an all-asteroid diet!',
			'I like bacon too! Buy some from my site! bakinsomebacon.com',
		];
		$articleContent = <<<EOF
Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,
lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit
labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow
**turkey** shank eu pork belly meatball non cupim.
Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur
laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,
capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing
picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt
occaecat lorem meatball prosciutto quis strip steak.
Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak
mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon
strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur
cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck
fugiat.
EOF;
		if ($slug === 'khaaaaaan') {
			$slack->sendMessage('Boo-ga-ga', 'Hello WTF');
		}
//		dump($isDebug);die;
		$articleContent = $markdownHelper->parse($articleContent);
		return $this->render('article/show.html.twig', [
			'title' => ucwords(str_replace('-', ' ', $slug)),
			'slug' => $slug,
			'comments' => $comments,
			'articleContent' => $articleContent,
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
