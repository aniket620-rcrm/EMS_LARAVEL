<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use App\Models\Salary;
use App\Models\Leave;

class UrlTest extends TestCase
{
    /**
     * Test if send email URL returns a 200 status code.
     *
     * @return void
     */
    //GET

    public function test_salary_returns_salaries_for_given_user_id()
{
    $id = 1;
    $salaries = Salary::where('user_id', $id)->get();
    $response = $this->get('/api/user/salary/'.$id);
    
    $response->assertOk();
    $response->assertJson($salaries->toArray());
}


    public function test_send_salary_url_returns_200()
    {
        $response = $this->withoutExceptionHandling()->get('/api/salaries', ['timeout' => 30]);
        $salaries = Salary::with('user.UserRole')
        ->orderByDate()
        ->get();
        $response->assertOk();
        $response->assertJson($salaries->toArray());
    }
    

    public function test_send_id_url_returns_recent_leave_200(){
        $id=1;
        $leave = Leave::where('user_id', $id)->orderBy('created_at','desc')->first();

        $response=$this->get('/api/leave/'.$id);
        $response->assertOk();
        $response->assertJson($leave->toArray());
    }

    

    public function test_send_id_url_returns_200(){
        $id = 4; 
        $user=User::where('id' , $id)->with('UserStatus','UserRole')->first();

        $response = $this->get('api/user/profile/'.$id);
        $response->assertOk();
        $response->assertJson($user->toArray());
    }

    public function test_send_id_url_salary_200(){
        $id=1;
        $salaries=Salary::where('user_id',$id)->get();
        $response=$this->get('api/user/salary/'.$id);
        $response->assertOk();
        $response->assertJson($salaries->toArray());
    }

   

    // POST
    public function test_send_leave_details_url_returns_200(){
        $requestData = [
            'user_id' => 1,
            'leave_start_date' => '2022-05-01',
            'leave_end_date' => '2022-05-05',
        ];
    
        $response = $this->post('/api/leave-request', $requestData);
        $response->assertStatus(201);
    
        $response->assertJson([
            'user_id' => $requestData['user_id'],
            'leave_start_date' => $requestData['leave_start_date'],
            'leave_end_date' => $requestData['leave_end_date'],
            'approval_status' => 2,
            'approved_by' => 'Pending',
        ]);
    
       
        $this->assertDatabaseHas('leaves', [
            'user_id' => $requestData['user_id'],
            'leave_start_date' => $requestData['leave_start_date'],
            'leave_end_date' => $requestData['leave_end_date'],
            'approval_status' => 2,
            'approved_by' => 'Pending',
        ]);
    }

    public function test_send_update_details_url_returns_json_200()
{
    
    $id=1;

    $data = [
        'id' => $id,
        'name' => 'Aman Tripathi',
        'email' => 'tripathiaman777@gmail.com',
        'phone' => '7880637505',
        'password' => 'password'
    ];

    $response = $this->post('/api/updateprofile', $data);

    $response->assertStatus(200);

    $response->assertJson([
        'id' => $id,
        'name' => 'Aman Tripathi',
        'email' => 'tripathiaman777@gmail.com',
        'phone' => '7880637505',
    ]);

    $this->assertDatabaseHas('users', [
        'id' => $id,
        'name' => 'Aman Tripathi',
        'email' => 'tripathiaman777@gmail.com',
        'phone' => '7880637505',
    ]);
}

    
    
    
    

}
