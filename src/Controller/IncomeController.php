<?php


namespace App\Controller;


use App\Entity\Expense;
use App\Entity\Income;
use App\Form\ExpenseType;
use App\Form\IncomeType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/incomes")
 * Class IncomeController
 * @package App\Controller
 */
class IncomeController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{

    /**
     * @Route("/add", name="income_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function add(Request $request)
    {
        $income = new Income();
        $form = $this->createForm(IncomeType::class, $income);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($income);
            $em->flush();
            $this->addFlash('success', 'Le revenu a bien été enregistré !');
            return $this->redirectToRoute('income_list');
        }

        return $this->render('income/add.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/", name="income_list")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function list()
    {
        $repo = $this->getDoctrine()->getRepository(Income::class);
        return $this->render('income/list.html.twig', [
            'incomes' => $repo->findBy([], ['date' => 'DESC'])
        ]);
    }

}