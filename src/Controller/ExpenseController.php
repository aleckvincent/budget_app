<?php


namespace App\Controller;


use App\Entity\Expense;
use App\Form\ExpenseType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/expenses")
 * Class ExpenseController
 * @package App\Controller
 */
class ExpenseController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{

    /**
     * @Route("/add", name="expense_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function add(Request $request)
    {
        $expense = new Expense();
        $form = $this->createForm(ExpenseType::class, $expense);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($expense);
            $em->flush();
            $this->addFlash('success', 'La dépense a bien été enregistré !');
            return $this->redirectToRoute('expense_list');
        }

        return $this->render('expense/add.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/", name="expense_list")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function list()
    {
        $repo = $this->getDoctrine()->getRepository(Expense::class);
        return $this->render('expense/list.html.twig', [
            'expenses' => $repo->findBy([], ['date' => 'DESC'])
        ]);
    }

}