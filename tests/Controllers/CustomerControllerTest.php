<?php


use App\Repository\CustomerRepository;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class ProgrammerControllerTest extends TestCase
{
    private $customerRepoObj;
    private $client;

    /**
     * SetUp the test environment.
     */
    protected function setUp(): void
    {
        $this->customerRepoObj = $this->createMock(CustomerRepository::class);
        $this->client = new GuzzleHttp\Client(['base_uri' => 'http://tax.test']);
    }

    /**
     * TearDown the test environment.
     */
    protected function tearDown() :void
    {
        $this->customerRepoObj = null;
    }
    /**
     * Test instance of $this->countryRepoObj.
     *
     * @test
     */
    public function testInstanceOf()
    {
        $this->assertInstanceOf(CustomerRepository::class, $this->customerRepoObj);
    }

    public function testIndexStatusCode()
    {
        $res = $this->client->request('GET', '/api/v1/customers');
        $response = $res->getStatusCode();

        return $this->assertSame(200, $response);
    }

    /**
     * test inserting.
     */
    public function testStore()
    {
        $data = [
            'name' => 'hoda',
            'address' => 'egypt-cairo',
        ];

        $response = $this->client->post('/api/v1/customers', [
            'body' => json_encode($data),
        ]);

        return $this->assertSame(200, $response->getStatusCode());
    }

    /**
     * test inserting.
     */
    public function testUpdate()
    {
        $data = [
            'id' => 1,
            'name' => 'hoda',
            'address' => 'egypt-cairo',
        ];

        $response = $this->client->put('api/v1/customers/1', [
            'body' => json_encode($data),
        ]);

        return $this->assertSame(200, $response->getStatusCode());
    }

    /**
     * test list api
     */
    public function testIndex()
    {

        $response = $this->client->get('api/v1/customers');
        $data=json_decode($response->getBody()->getContents());

        return $this->assertIsArray($data->data);
    }

    /**\
     *
     */
    public function testIndexHasValidKey()
    {

        $response = $this->client->get('api/v1/customers');
        $data=json_decode($response->getBody()->getContents());

        return $this->assertObjectHasAttribute('id',$data->data[0]);
    }

    public function testDelete()
    {
        $id=1;
        $response = $this->client->delete('/api/v1/customers/'.$id);

        return $this->assertSame(200, $response->getStatusCode());
    }

    /**
     * test item is already deleted from db
     *
     */
    public function testIsDelete()
    {
        $id=1;
        $response = $this->client->get('/api/v1/customers'.$id);
        return $this->assertSame(404, $response->getStatusCode());
    }
}
