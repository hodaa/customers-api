<?php


namespace App\Controllers;

use App\Repository\CustomerRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CustomerController
{
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $customers = $this->customerRepository->findAll();

        return new JsonResponse($customers);
    }

    /**
     * @param Request $request
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->request->all();
        $this->customerRepository->store($data);

        return new JsonResponse('Customer Saved Successfully');
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function show(Request $request)
    {
        $id = $request->attributes->get('id');
        $customer = $this->customerRepository->find($id);

        if ($customer) {
            return new JsonResponse($customer);
        }

        return new JsonResponse(['message' => 'Customer not found']);
    }

    /**
     * @param Request $request
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @return Response
     */
    public function delete(Request $request)
    {
        $id = $request->attributes->get('id');
        $this->customerRepository->delete($id);

        return new JsonResponse('Customer Deleted');
    }

    /**
     * @param Request $request
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @return Response
     */
    public function update(Request $request)
    {
        $id = $request->attributes->get('id');
        $name = $request->request->get('name');

        $this->customerRepository->update($id, $name);

        return new JsonResponse('Customer updated');
    }
}
