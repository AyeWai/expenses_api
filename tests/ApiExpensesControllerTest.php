<?php

use App\Entity\Expenses;
use App\DataFixtures\ExpensesFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use App\Controller\ApiExpensesController;
use App\Repository\ExpensesRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;



class ApiExpensesControllerTest extends WebTestCase
{
    protected $databaseTool;

    public function setUp(): void
    {
        parent::setUp();

        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function testGetExpenses(ExpensesRepository $expensesRepository)
    {
        // If you need a client, you must create it before loading fixtures because
        // creating the client boots the kernel, which is used by loadFixtures
        $client = $this->createClient();

        // add all your fixtures classes that implement
        // Doctrine\Common\DataFixtures\FixtureInterface
        $this->databaseTool->loadFixtures([
            'App\DataFixtures\ExpensesFixtures',
        ]);


        // Arrange
        $this->databaseTool->loa([ExpensesFixtures::class]);
        $mockedExpensesRepository = $this->getMockBuilder(ExpensesRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

            $expense = new Expenses();
            $expense->setDate(new DateTime('02-03-2023'));
            $expense->setAmount(23);
            $expense->setRegisteringdate(new DateTime(date('j-m-Y')));
            $expense->setCompanyname('Kiss The Bride');
            $expense->setUser($this->getReference(UserFixtures::USER1));
            $expense->setExpensestype($this->getReference(ExpensesTypeFixtures::REPAS));
    
            $expense2 = new Expenses();
            $expense2->setDate(new DateTime('21-01-2023'));
            $expense2->setAmount(111);
            $expense2->setRegisteringdate(new DateTime(date('j-m-Y')));
            $expense2->setCompanyname('Kiss The Bride');
            $expense2->setUser($this->getReference(UserFixtures::USER1));
            $expense2->setExpensestype($this->getReference(ExpensesTypeFixtures::CONFERENCE));

        $mockedExpensesRepository->expects($this->once())
        ->method('findAll')
        ->willReturn([$expense, $expense2]);
        
        $controller = new ApiExpensesController();
        
        // Act
        $response = $controller->getexpenses($expensesRepository);
        
        // Assert
        $this->assertEquals(200, $response->getStatusCode());
        $expectedJson = '[
            {
              "id": 2,
              "date": "2023-03-02T00:00:00+00:00",
              "amount": 23,
              "registeringdate": "2023-04-03T00:00:00+00:00",
              "companyname": "Kiss The Bride",
              "user": {
                "id": 2,
                "firstname": "Thomas",
                "lastname": "Roger",
                "mail": "thomas.roger@ktb.fr",
                "birthday": "1983-02-01T00:00:00+00:00",
                "expenses": [
                  2,
                  {
                    "id": 3,
                    "date": "2023-01-21T00:00:00+00:00",
                    "amount": 111,
                    "registeringdate": "2023-04-03T00:00:00+00:00",
                    "companyname": "Kiss The Bride",
                    "user": 2,
                    "expensestype": {
                      "id": 12,
                      "label": "CONFERENCE",
                      "__isCloning": false
                    }
                  }
                ],
                "__isCloning": false
              },
              "expensestype": {
                "id": 11,
                "label": "REPAS",
                "__isCloning": false
              }
            },
            {
              "id": 3,
              "date": "2023-01-21T00:00:00+00:00",
              "amount": 111,
              "registeringdate": "2023-04-03T00:00:00+00:00",
              "companyname": "Kiss The Bride",
              "user": {
                "id": 2,
                "firstname": "Thomas",
                "lastname": "Roger",
                "mail": "thomas.roger@ktb.fr",
                "birthday": "1983-02-01T00:00:00+00:00",
                "expenses": [
                  {
                    "id": 2,
                    "date": "2023-03-02T00:00:00+00:00",
                    "amount": 23,
                    "registeringdate": "2023-04-03T00:00:00+00:00",
                    "companyname": "Kiss The Bride",
                    "user": 2,
                    "expensestype": {
                      "id": 11,
                      "label": "REPAS",
                      "__isCloning": false
                    }
                  },
                  3
                ],
                "__isCloning": false
              },
              "expensestype": {
                "id": 12,
                "label": "CONFERENCE",
                "__isCloning": false
              }
            }
          ]';
        $this->assertJsonStringEqualsJsonString($expectedJson, $response->getContent());
        
    }
}