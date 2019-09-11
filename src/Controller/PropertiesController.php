<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PropertiesController extends  AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(PropertyRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @route ("/biens", name = "properties.index")
     * @return Response
     */
    public function index() : Response
    {

        return $this->render("property/index.html.twig",[
            'current_menu' => 'properties'
        ]);

    }

    /**
     * *@route ("/biens/{slug}-{id}", name = "property.show", requirements={"slug":"[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Property $property, string  $slug) :Response
    {
        if($property->getSlug() !== $slug){
            return $this->redirectToRoute('property.show',[
                'id' =>$property->getId(),
                'slug' =>$property->getSlug()
            ], 301);
        }
        return $this->render("property/show.html.twig",[
            'current_menu' => 'properties',
            'property' => $property
        ]);
    }
}
