<?php

use Illuminate\Database\Seeder;

class NatureOfEnquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $natureOfEnquiries = [
            ['title' => 'Migration Advice', 'status' => 1],
            ['title' => 'Migration Consultation', 'status' => 1],
            ['title' => 'Student visa/ Admission', 'status' => 1],
            ['title' => 'Tourist visa', 'status' => 1],
            ['title' => 'UK/CANADA/ EUROPE TO AUSTRALIA', 'status' => 1],
            ['title' => 'Course Change/ Admission/ Student Visa', 'status' => 1],
            ['title' => 'Work Visa', 'status' => 1],
            ['title' => 'Family Visa', 'status' => 1],
        ];

        foreach ($natureOfEnquiries as $enquiry) {
            \App\Models\NatureOfEnquiry::create($enquiry);
        }
    }
}
