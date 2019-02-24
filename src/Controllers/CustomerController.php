<?php


namespace App\Controllers;

use App\Repository\CustomerRepository;

use App\Traits\ResponseHandler;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class CustomerController
{
    use ResponseHandler;

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

        return $this->successWithData($customers);
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

        return $this->success("Customer Saved Successfully");
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function show(Request $request)
    {
        $id = $request->attributes->get('id');
        $customer = $this->customerRepository->find($id);

        if (!$customer) {
            return $this->notFound("Customer Not Exist");
        }

        return $this->successWithData($customer);

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request)
    {
        $id = $request->attributes->get('id');
        $deletd=$this->customerRepository->delete($id);
        if(!$deletd){
            return $this->notFound("Customer Not Exists");
        }
        return $this->success("Customer Deleted");
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

       return $this->success("Customer updated");
    }
}
