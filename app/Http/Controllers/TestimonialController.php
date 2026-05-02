<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = [
            [
                'name'     => 'Sarah Mitchell',
                'position' => 'CEO, BrightEdge Corp',
                'rating'   => 5,
                'text'     => 'Absolutely outstanding experience from start to finish. The team delivered beyond our expectations with premium quality and attention to detail that truly sets them apart.',
                'image'    => 'https://i.pravatar.cc/100?img=1',
            ],
            [
                'name'     => 'James Thornton',
                'position' => 'Marketing Director, NovaTech',
                'rating'   => 5,
                'text'     => 'Working with this team was a game-changer for our brand. Their creative approach and dedication to excellence produced results we are incredibly proud of.',
                'image'    => 'https://i.pravatar.cc/100?img=3',
            ],
            [
                'name'     => 'Amelia Rodriguez',
                'position' => 'Founder, LuxeStyle',
                'rating'   => 4,
                'text'     => 'A seamless and professional journey. Every detail was handled with care, and the final product exceeded what we imagined. Highly recommended to anyone seeking quality.',
                'image'    => 'https://i.pravatar.cc/100?img=5',
            ],
            [
                'name'     => 'Daniel Park',
                'position' => 'CTO, Finwave Solutions',
                'rating'   => 5,
                'text'     => 'The level of craftsmanship and professionalism is unmatched. Our project was delivered on time, on budget, and with incredible attention to every requirement.',
                'image'    => 'https://i.pravatar.cc/100?img=7',
            ],
            [
                'name'     => 'Olivia Bennett',
                'position' => 'Head of Design, AuraStudio',
                'rating'   => 5,
                'text'     => 'From concept to completion, the process was smooth and inspiring. The results speak for themselves — elegant, functional, and perfectly aligned with our vision.',
                'image'    => 'https://i.pravatar.cc/100?img=9',
            ],
            [
                'name'     => 'Marcus LeClaire',
                'position' => 'Operations Manager, TerraGroup',
                'rating'   => 4,
                'text'     => 'Reliable, talented, and genuinely invested in our success. The team brought fresh ideas while staying true to our brand values. We look forward to future collaborations.',
                'image'    => 'https://i.pravatar.cc/100?img=11',
            ],
        ];

        return view('testimonials', compact('testimonials'));
    }
}
