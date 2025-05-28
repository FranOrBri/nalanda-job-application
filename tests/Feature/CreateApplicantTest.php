<?php

namespace Tests\Feature;

use Tests\TestCase;

class CreateApplicantTest extends TestCase
{
    public function test_create_applicant(): void
    {
        $data = [
            'name' => 'Test1',
            'email' => 'test1@example.com',
            'exp' => 5,
            'cv' => 'This is my CV',
        ];

        $response = $this->post('api/create-applicant', $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('applicants', $data);

    }
}
