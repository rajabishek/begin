<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class TaskApiTest extends TestCase
{
    /**
     * Wraps every test case within a database transaction.
     *
     * @see \Laravel\Lumen\Testing\DatabaseTransactions
     */
    use DatabaseTransactions;

    /**
     * JSON Web token for the authenticated user.
     *
     * @var string
     */
    protected $token;

    /**
     * Create a random dummy user and authenticate him before every test.
     *
     * @param void
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        
        $user = factory('Begin\User')->create();
        $this->token = Auth::generateTokenById($user->id);
    }

    /**
     * Get the HTTP Autherization header from the token.
     *
     * @param void
     * @return array
     */
    protected function getAuthorizationHeader()
    {
        return ['HTTP_AUTHORIZATION' => 'Bearer ' . $this->token];
    }
    
    /**
     * Test that the user must be autheticated to access the following routes.
     *
     * @return void
     */
    public function testEndpointsMustBeAuthenticated()
    {
        $response = [
            'errors' =>  ['Please provide a token'],
            'success' => false
        ];
        
        $this->get('api/v1/tasks')->seeJsonEquals($response);
        $this->get('api/v1/tasks/pending')->seeJsonEquals($response);
        $this->get('api/v1/tasks/completed')->seeJsonEquals($response);
        $this->post('api/v1/tasks')->seeJsonEquals($response);
        $this->get('api/v1/tasks/1')->seeJsonEquals($response);
        $this->put('api/v1/tasks/1')->seeJsonEquals($response);
        $this->delete('api/v1/tasks/1')->seeJsonEquals($response);
    }
}
