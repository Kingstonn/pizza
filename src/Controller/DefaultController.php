<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\Entity\Pizza;
use App\Entity\Ingredient;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DataType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\commande;
class DefaultController extends Controller
{
  
    /**
 * @Route("/",name="home")
 * @Template()
 */
public function indexAction()
{
    return [];
}
  

    /**
     * @Route("/pizzas", name="pizzas_list")
     * @Template()
     */
    public function pizzasAction()
    {  
        $em = $this->getDoctrine()->getManager();
        
        $pizzas = $em->getRepository(Pizza::class)
        ->findAll();
     
        return $this->render('default/pizzas.html.twig', ['pizzas' => $pizzas]);
        
    }
        /**
     * @Route("/ingredients", name="ingredients_list")
     * @Template()
     */
    public function ingredientsAction()
    {  
        $em = $this->getDoctrine()->getManager();
        
        $ingredients = $em->getRepository(Ingredient::class)
        ->findAll();
     
        return $this->render('default/ingredients.html.twig', ['ingredients' => $ingredients]);
        
    }
    /**
     * @Route("addpizza",name="addpizza")
     */

    public function add_pizza(Request $request)
    {
        $pizza =new Pizza();
        $form= $this->createFormBuilder($pizza)
        ->add('name',TextType::class)
        ->add('description',TextType::class)
        ->add('price',TextType::class)
        ->add('Register',SubmitType::class,array('label'=>'Ajouter Pizza'))
        ->getForm();
       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
          

           $nom = $form['name']->getData();
           $description = $form['description']->getData();
           $prix = $form['price']->getData();
          
           $pizza->setPrice($prix);
           $pizza->setName($nom);
           $pizza->setDescription($description);

           $em=$this->getDoctrine()->getManager();

           $em->persist($pizza);
           $em->flush();
   
   
       }


        return $this->render('default/addpizza.html.twig',array('form'=>$form->createView(),
       ));
    }



        /**
     * @Route("/commande", name="commande")
     * @Template()
     */
    public function show_commande_()
    {  
        $em = $this->getDoctrine()->getManager();
        
        $cdms = $em->getRepository(commande::class)
        ->findAll();
     
        return $this->render('default/showcom.html.twig', ['cdms' => $cdms]);
        
    }

    /**
     * @Route("addcom",name="addcom")
     */

    public function add_comm(Request $request)
    {
        $commande =new commande();


        $form= $this->createFormBuilder($commande)
        ->add('adresse',TextType::class)
        ->add('nom',TextType::class)
        ->add('numero',TextType::class)
        ->add('ADD',SubmitType::class,array('label'=>'Ajouter'))
        ->getForm();
       

       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {

           $adresse = $form['adresse']->getData();
           $nom = $form['nom']->getData();
           $numero = $form['numero']->getData();
          
           $commande->setAdresse($adresse);
           $commande->setNom($nom);
           $commande->setNumero($numero);

           $em=$this->getDoctrine()->getManager();

           $em->persist($commande);
           $em->flush();
   
   
       }

        return $this->render('default/addcom.html.twig',array('form'=>$form->createView(),

       ));
    }



}
