<?php


namespace App\Controllers;

use App\Repository\CustomerRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CustomerController
{
    private $customerRepository;

    /**
     * CustomerController constructor.
     * @param CustomerRepository $customerRepository
     */
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

        return new JsonResponse(["data"=>$customers,"status"=>200]);
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
            return new JsonResponse(["data"=>$customer,"status"=>200]);
        }

        return new JsonResponse(['message' => 'Customer not found']);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request)
    {
        $id = $request->attributes->get('id');
        $this->customerRepository->delete($id);

        return new JsonResponse(["message"=>'Customer Deleted',"status"=>"200"]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(Request $request)
    {
        $id = $request->attributes->get('id');
        $data=$request->request->all();
        $this->customerRepository->update($id, $data);

        return new JsonResponse(["message"=>'Customer updated',"status"=>"200"]);
    }
}
