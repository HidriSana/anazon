<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\AddCategoryType;
use App\Form\FilterCategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/categories', name: 'app_category')]
    public function index(CategoryRepository $categoryRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $form = $this->createForm(FilterCategoryType::class);
        $form->handleRequest($request);

        $categories = $paginator->paginate(
            $categoryRepository->getListQueryBuilder('c'), /* query NOT result */
            $request->query->getInt('page', 1),/*page number*/
            2 /*limit per page*/
        );

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
            'form' => $form
        ]);
    }
    #[Route('/categories/{id<^\d+$>}', name: 'app_category_show_by_id')]
    public function showById(Category $category): Response
    {
        return $this->render('category/showCategoryById.html.twig', [
            'category' => $category,
        ]);
    }
    #[Route('/categories/addCategory', name: 'add_category')]
    public function addCategory(Request $request, EntityManagerInterface $newCategory): Response
    {
        $form = $this->createForm(AddCategoryType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newCategory->persist($form->getData());
            $newCategory->flush();
            return $this->redirectToRoute('app_category');
        }
        return $this->render('category/add_category.html.twig', [
            'form' => $form
        ]);
    }
    #[Route('/categories/{id<^\d+$>}/editCategory', name: 'edit_category')]
    public function editCategory(Category $category, Request $request, EntityManagerInterface $categoryToEdit): Response
    {
        $form = $this->createForm(AddCategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryToEdit->flush();

            return $this->redirectToRoute('app_category');
        }
        return $this->render('category/edit_category.html.twig', [
            'category' => $category,
            'form' => $form
        ]);
    }
}
