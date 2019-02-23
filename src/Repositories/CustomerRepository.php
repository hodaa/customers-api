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

    public function index()
    {
        $this->entityManager->getRepository(Customer::class);
    }

    public function findAll()
    {
        $productRepository = $this->entityManger->getRepository(Customer::class);

        return $productRepository->findAll();
    }

    /**
     * @param $album
     * @param $artist
     * @param mixed $data
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @return Album
     */
    public function store($data)
    {
        $customer = new Customer();

        $customer->setName($data['name']);
        $customer->setAddress($data['address']);

        $this->entityManger->persist($customer);
        $this->entityManger->flush();

        return true;
    }

    public function find($id)
    {
        return $this->entityManger->find(Customer::class, $id);
    }

    public function delete($id)
    {
        $customer = $this->entityManger->find(Customer::class, $id);
        $this->entityManger->remove($customer);
        $this->entityManger->flush();

        return true;
    }

    /**
     * @param $id
     * @param $name
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @return bool
     */
    public function update($id, $name)
    {
        $customer = $this->find($id);
        if ($customer) {
            $customer->setName($name);

            $this->entityManger->persist($customer);
            $this->entityManger->flush();

            return true;
        }

        return false;
    }
}
