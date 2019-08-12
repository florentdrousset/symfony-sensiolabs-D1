<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    public $books;

    public function __construct() {
        $this->books = [['id' => '0',
            'titre' => '1Q84',
            'auteur' => 'Haruki Murakami',
            'parution' => new \DateTime('2012-01-01'),
            'presentation' => 'Très bon bouquin'
        ], [
            'id' => '1',
            'titre' => 'Des hommes sans femmes',
            'auteur' => 'Haruki Murakami',
            'parution' => new \DateTime('2017-01-01'),
            'presentation' => 'Excellent livre'
        ],
            [
                'id' => '2',
                'titre' => 'Les Misérables',
                'auteur' => 'Victor Hugo',
                'parution' => new \DateTime('1862-01-01'),
                'presentation' => 'Très bon bouquin'
            ]];
    }
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
        $books = $this->books;
        return $this->render('default/books.html.twig', [
            'books' => $books
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @Route("/details/{id}", name="details")
     */
    public function bookDetailAction(Request $request, $id) {
        $books = $this->books;
        return $this->render('default/details.html.twig', [
                'books' => $books[$id]
            ]);
    }

    /**
     * @Route("/auteur/{nom}", name="auteur")
     */
    public function auteurAction($auteur) {
        $books = $this->books;
        $selection = array_filter($books, function($books) use ($auteur) {
           return $books['auteur'] == $auteur;
        });
        return
            $this->render('default/author.html.twig', [
            'selection' => $selection
       ]);
    }
}
