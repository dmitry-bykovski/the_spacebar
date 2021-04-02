<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController
{
	/**
	 * @Route("/")
	 */
	public function homepage()
	{
		return new Response('It is work! My firts homepage');
	}
	/**
	 * @Route("/news/{slug}")
	 */
	public function show($slug)
	{
		return new Response(sprintf('Mother Fucker <br> %s',$slug));
	}
}