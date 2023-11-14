<?php
/**
 * User: broasca
 * Date: 15.02.2023
 * Time: 17:21
 */

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

	#[Route('/', name: 'index')]
	public function index(): Response
	{
		return $this->render("index.html.twig");
	}


}
