<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Recruitment\Domain\Entities\Applicant;
use Recruitment\Domain\ValueObjects\ApplicantCv;
use Recruitment\Domain\ValueObjects\ApplicantEmail;
use Recruitment\Domain\ValueObjects\ApplicantExp;
use Recruitment\Domain\ValueObjects\ApplicantName;

class ApplicantValidateTest extends TestCase
{
    public function test_applicant_validation_is_valid(): void
    {
        $applicant = new Applicant(
            new ApplicantName("Test1"),
            new ApplicantEmail("test1@example.com"),
            new ApplicantExp(5),
            new ApplicantCv("This is my CV")
        );

        $applicant->validate();

        $this->assertTrue($applicant->validate());
    }

    public function test_applicant_validation_is_not_valid_by_exp(): void
    {
        $applicant = new Applicant(
            new ApplicantName("Test1"),
            new ApplicantEmail("test1@example.com"),
            new ApplicantExp(1),
            new ApplicantCv("This is my CV")
        );

        $applicant->validate();

        $this->assertFalse($applicant->validate());
    }

    public function test_applicant_validation_is_not_valid_by_cv(): void
    {
        $applicant = new Applicant(
            new ApplicantName("Test1"),
            new ApplicantEmail("test1@example.com"),
            new ApplicantExp(5),
            new ApplicantCv("")
        );

        $applicant->validate();

        $this->assertFalse($applicant->validate());
    }
}
