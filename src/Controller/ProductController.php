<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'app_product')]
    public function index(EntityManagerInterface $em): Response
    {
        $products = $em->getRepository(Product::class)->findAll();
        //dd($products);
        
        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
       
    }


    #[Route('/products/{id}', name: 'product_show')]
    public function show( $id, EntityManagerInterface $em): Response
    {
    
        $product = $em->getRepository(Product::class)->findOneBy(['id'=>$id]);


        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }


}

