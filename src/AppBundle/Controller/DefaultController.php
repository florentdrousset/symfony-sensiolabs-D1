<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        /* La méthode 'render' va construire la vue.
        1er paramètre : lien vers la vue. Celui-ci se trouve dans le dossier app/resources/views
        2eme paramètre : tableau associatif. 'base_dir' va devenir une variable native dans notre template.
        */
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
     public function aboutAction() {
        return $this->render('default/about.html.twig', [
        ]);

     }

    /**
     * @param string $prenom
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/about/{prenom}", name="aboutname")
     */

    public function aboutController(string $prenom, Request $request) {
        $prenom = ucfirst($prenom);
        return $this->render('default/about.html.twig', [
            'p' => $prenom
        ]);
        //Par ce mécanisme, je transmet la valeur de ma variable au template about
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/books", name="books")
     */
    public function bookAction(Request $request) {
        $books = ['titre' => '1Q84',
            'auteur' => 'Haruki Murakami',
            'parution' => '2012',
            'presentation' => 'Très bon bouquin'
        ];

        return $this->render('default/books.html.twig', [
            'books' => $books
        ]);
    }
}
