<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Expenses;
use App\Repository\ExpensesRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Request;

class ApiExpensesController extends AbstractController
{
    #[Route('/api/expenses', name: 'app_api_expenses')]
    public function getexpenses(ExpensesRepository $expensesRepository): JsonResponse
    {
        $expenses = $expensesRepository->findAll();
        if(!$expenses){
            throw $this->createNotFoundException(
                'No expenses found'
            );
        }
        
        return $this->json($expenses, 200, [], ['circular_reference_handler' => function ($object) {
            return $object->getId();
        }]);
        
    }

    #[Route('/api/expense/{id}', name: 'app_api_expense', methods: ['GET'])]
    public function getexpense(ExpensesRepository $expensesRepository, int $id): JsonResponse
    {
        $expense = $expensesRepository->findBy(['id'=>$id]);
        if(!$expense){
            throw $this->createNotFoundException(
                'No expenses found with id '. $id
            );
        }
        dump($expense);
        return $this->json($expense, 200, [], ['circular_reference_handler' => function ($object) {
            return $object->getId();
        }]);
        
    }

    #[Route('/api/expense/new', name: 'app_api_new_expense', methods: ['POST'])]
    public function newexpense(ExpensesRepository $expensesRepository, Request $request): JsonResponse
    {
        $parameters = json_decode($request->getContent(), true);
        $expense = new Expenses();
        $expense->setDate(new DateTime($parameters['date']));
        $expense->setAmount($parameters['amount']);
        $expense->setExpensestype($parameters['type']);
        $expense->setRegisteringdate(new DateTime());
        $expense->setCompanyname($parameters['companyname']);
        $expensesRepository->save($expense, true);

        return $this->json($expense, 200, [], ['circular_reference_handler' => function ($object) {
            return $object->getId();
        }]);
    }

    #[Route('/api/expense/edit/{id}', name: 'app_api_edit_expense', methods: ['PUT'])]
    public function editexpense(ExpensesRepository $expensesRepository, Request $request, int $id): JsonResponse
    {
        $parameters = json_decode($request->getContent(), true);
        $expense = $expensesRepository->find($id);
        $expense->setDate(new DateTime($parameters['date']));
        $expense->setAmount($parameters['amount']);
        $expense->setExpensestype($parameters['type']);
        $expense->setRegisteringdate(new DateTime());
        $expense->setCompanyname($parameters['companyname']);
        $expensesRepository->save($expense, true);
        
        return $this->json([
            'message' => 'Expense with id '. $id .' edited'
        ]);
    }

    #[Route('/api/expense/del/{id}', name: 'app_api_del_expense', methods: ['POST'])]
    public function index(ExpensesRepository $expensesRepository, int $id): JsonResponse
    {   
        $expense = $expensesRepository->find($id);
        $expensesRepository->remove($expense, true);

        return $this->json([
            'message' => 'Expense with id '. $id .' deleted'
        ]);
    }
}
