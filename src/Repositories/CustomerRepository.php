<?php


namespace App\Repository;

use App\Entities\Customer;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;

class CustomerRepository
{
    /**
     * CustomerRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    private $entityManger;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManger = $entityManager;
    }

    /**
     * @return array|object[]
     */
    public function findAll(): array
    {
        $customerRepo = $this->entityManger->getRepository(Customer::class);
        $items = $customerRepo->findAll();

        $data = [];
        foreach ($items as $item) {
            $data[] = $this->listItemDetails($item);
        }

        return $data;
    }

    /**
     * @param $album
     * @param $artist
     * @param mixed $data
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @return bool
     */
    public function store($data): bool
    {
        $customer = new Customer();

        $customer->setName($data['name']);
        $customer->setAddress($data['address']);

        $this->entityManger->persist($customer);
        $this->entityManger->flush();

        return true;
    }

    /**
     * @param int $id
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     *
     * @return array
     */
    public function find(int $id)
    {
        $item = $this->entityManger->find(Customer::class, $id);

        if ($item) {
            return $this->listItemDetails($item);
        }

        return false;
    }

    public function delete($id)
    {
        $customer = $this->entityManger->find(Customer::class, $id);
        if(!$customer){
            return false;
        }
        $this->entityManger->remove($customer);
        $this->entityManger->flush();

        return true;
    }

    /**
     * @param $id
     * @param $name
     * @param mixed $data
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @return bool
     */
    public function update(int $id, array $data)
    {
        $customer = $this->entityManger->find(Customer::class, $id);
        if ($customer) {
            $customer->setName($data['name']);
            $customer->setAddress($data['address']);

            $this->entityManger->persist($customer);
            $this->entityManger->flush();

            return true;
        }

        return false;
    }

    /**
     * @param $items
     *
     * @return array
     */
    private function listItemDetails(object $item): array
    {
        return [
            'id' => $item->getId(),
            'name' => $item->getName(),
            'address' => $item->getAddress(),
        ];
    }
}
