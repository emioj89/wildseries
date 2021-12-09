<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category", name="category_")
 */
class CategoryController extends AbstractController
{
    /**
     * Undocumented function
     *
     * @return Response
     *
     * @Route("/", name="index")
     */
    public function index(): Response

    {
        $categorys = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('category/index.html.twig', ['categorys' => $categorys]);
    }


    /**
     * Undocumented function
     *
     * @param string $categoryName
     * @return Response
     *
     * @Route("/{categoryName}",  methods = "get" , requirements = {"categoryName" = "[^/]+"}, name = "show")
     */
    public function show(string $categoryName): Response
    {
        $category = $this->getDoctrine()
        ->getRepository(Category::class)
            ->findOneBy(['name' => $categoryName]);

        if (!$category) {
            throw $this->createNotFoundException(
                'Aucune catégorie nommée ' . $categoryName
            );
        }

        $programs = $this->getDoctrine()
        ->getRepository(Program::class)
        ->findBy(['category' => $category->getId()], ['id'=>'DESC'], 3 ,0);


        return $this->render('category/show.html.twig', [
            'categoryName' => $categoryName, 'programs' => $programs
        ]);
    }
}
