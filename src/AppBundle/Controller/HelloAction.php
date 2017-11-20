<?php

namespace AppBundle\Controller;


use AppBundle\AppBundle;
use AppBundle\Entity\Recipe;
use Doctrine\Common\Annotations\Annotation\Target;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class HelloAction extends Controller
{
    /**
     * @Route("/hello/{name}")
     */
    public function helloAction($name){


        return $this->render('hello.html.twig',array(
            'name'=>$name,
        ));
    }

    /**
     * @Route("/api/recipes/{id}")
     * @Method("GET")
     */
    public function recipe($id){
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($id);
        $recipe= array('id'=>$recipe->getId(),'name'=>$recipe->getName(),'description'=>$recipe->getDescription(),'text'=>$recipe->getText());
        return new Response( json_encode($recipe));
    }

    /**
     * @Route("/api/recipes")
     * @Method("GET")
     */
    public function recipes(){
        $recipes = $this->getDoctrine()->getRepository(Recipe::class)->findAll();

        $result =array();
        foreach ($recipes as $recipe){
            $result[]=(['id'=>$recipe->getId(),'name'=>$recipe->getName(),'description'=>$recipe->getDescription(),'text'=>$recipe->getText()]);
        }
        return new Response( json_encode($result));
    }
    /**
     * @Route("/api/recipes")
     * @Method("POST")
     */
    public function createRecipe(Request $request){
        $em = $this->getDoctrine()->getManager();
        $recipe= new Recipe();
        $keys = $request->request->keys();
        foreach ($keys as $item =>$value){
            $callfun = 'set'.$keys[$item];
            if(method_exists(Recipe::class,$callfun)){
                $recipe->$callfun($request->request->get($value));
            }
        }
        $validator = $this->get('validator');
        $errors = $validator->validate($recipe);
        if(count($errors)>0){
            $response = $errors;
            $status = 204;
        }else{
            $em->persist($recipe);
            $em->flush();
            $response = json_encode(['status'=>'ok']);
            $status = 200;
        }
        return new Response($response,$status);
    }
    /**
     * @Route("/api/recipes/{id}")
     * @Method("PUT")
     */
    public function updateRecipe($id,Request $request){
        $em = $this->getDoctrine()->getManager();
        $recipe = $em->getRepository(Recipe::class)->find($id);
        $keys = $request->request->keys();
        foreach ($keys as $item =>$value){
            $callfun = 'set'.$keys[$item];
            if(method_exists(Recipe::class,$callfun)){
                $recipe->$callfun($request->request->get($value));
            }
        }
        $em->persist($recipe);
        $em->flush();
        return new Response(json_encode(['status'=>'ok']));

    }

    /**
     * @Route("/api/recipes/{id}")
     * @Method("DELETE")
     */
    public function deleteRecipe($id){
        $em= $this->getDoctrine()->getManager();
        $recipe = $em->getRepository(Recipe::class)->find($id);
        $em->remove($recipe);
        $em->flush();
        return new Response(json_encode(['status'=>'ok']));
    }


}