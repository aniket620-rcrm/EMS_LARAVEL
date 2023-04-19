<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User; // Import the User class or any other relevant classes from your application

class AdminTest extends TestCase
{
    // Employee Login Test Cases

    use RefreshDatabase; // Use the RefreshDatabase trait to reset the database after each test

    public function testSuccessfulLoginWithValidCredentials()
    {
        // Create a User instance in the database
        $user = User::factory()->create([
            'email' => 'ayu8058020@gmail.com',
            'password' => bcrypt('password'),
        ]);

        // Send a POST request with valid username and password
        $response = $this->post('/api/login', [
            'email' => 'ayu8058020@gmail.com',
            'password' => 'password',
        ]);

        // Assert that the response is successful (e.g., HTTP status code 200)
        $response->assertStatus(200);

        // Assert that the response contains a success message (assuming it returns a JSON response)
        $response->assertJson([
            'message' => 'Login successful',
        ]);
    }// Use assertStringContainsString() instead of assertJsonStringContainsString()
    




    // public function testLoggingInWithNonExistingUsernameResultsInErrorMessage()
    // {
    //     // Test logic to verify error message for non-existing username
    //     $this->assertTrue(true);
    // }

    // // Employee Leave Management Test Cases
    // public function testEmployeeCanApplyForLeavesOfDifferentTypes()
    // {
    //     // Test logic to verify leave application for different types
    //     $this->assertTrue(true);
    // }

    // public function testLeaveApplicationsAreProperlyProcessedAccordingToCompanyPolicies()
    // {
    //     // Test logic to verify leave processing based on company policies
    //     $this->assertTrue(true);
    // }

    // public function testEmployeeCanViewLeaveBalancesAccurately()
    // {
    //     // Test logic to verify accurate leave balance for employees
    //     $this->assertTrue(true);
    // }

    // // Employee Payroll Tracking Test Cases
    // public function testPayrollInformationIsAccuratelyRecordedAndCalculated()
    // {
    //     // Test logic to verify accurate recording and calculation of payroll information
    //     $this->assertTrue(true);
    // }

    // public function testPayrollCalculationsFollowCompanyPoliciesAndTaxRegulations()
    // {
    //     // Test logic to verify payroll calculations based on company policies and tax regulations
    //     $this->assertTrue(true);
    // }

    // public function testSystemGeneratesAccuratePayrollReportsForDifferentPeriods()
    // {
    //     // Test logic to verify accurate generation of payroll reports
    //     $this->assertTrue(true);
    // }

    // // User Roles and Permissions Test Cases
    // public function testDifferentUsersHaveAppropriateRolesAndPermissions()
    // {
    //     // Test logic to verify appropriate roles and permissions for different users
    //     $this->assertTrue(true);
    // }

    // public function testUserRolesCanBeAssignedModifiedAndRevokedAccurately()
    // {
    //     // Test logic to verify accurate assignment, modification, and revocation of user roles
    //     $this->assertTrue(true);
    // }

    // public function testUnauthorizedUsersAreRestrictedFromAccessingRestrictedFunctionalities()
    // {
    //     // Test logic to verify restriction of unauthorized users from accessing restricted functionalities
    //     $this->assertTrue(true);
    // }
}


