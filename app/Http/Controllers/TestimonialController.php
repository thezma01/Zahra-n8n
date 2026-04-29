<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display the testimonials page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $testimonials = [
            [
                'name'     => 'Sophia Reynolds',
                'position' => 'CEO, BrightEdge Corp',
                'image'    => 'https://i.pravatar.cc/150?img=47',
                'rating'   => 5,
                'text'     => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula felis at libero tincidunt, vel tincidunt enim lacinia. Their service exceeded every expectation we had.',
            ],
            [
                'name'     => 'Marcus Donovan',
                'position' => 'Founder, Nexora Studio',
                'image'    => 'https://i.pravatar.cc/150?img=12',
                'rating'   => 5,
                'text'     => 'Pellentesque habitant morbi tristique senectus et netus. The team delivered outstanding results on time and within budget. Truly a world-class experience.',
            ],
            [
                'name'     => 'Amelia Foster',
                'position' => 'Marketing Director, Lumos Co.',
                'image'    => 'https://i.pravatar.cc/150?img=32',
                'rating'   => 4,
                'text'     => 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae. Working with this team transformed our brand presence completely.',
            ],
            [
                'name'     => 'James Whitfield',
                'position' => 'CTO, Stackify Labs',
                'image'    => 'https://i.pravatar.cc/150?img=65',
                'rating'   => 5,
                'text'     => 'Donec posuere vulputate arcu. Phasellus accumsan cursus velit. The technical expertise demonstrated was remarkable — every feature was pixel-perfect.',
            ],
            [
                'name'     => 'Isabella Chen',
                'position' => 'Product Manager, Velos Inc.',
                'image'    => 'https://i.pravatar.cc/150?img=44',
                'rating'   => 5,
                'text'     => 'Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. They brought a fresh, innovative perspective to every challenge we presented.',
            ],
            [
                'name'     => 'Oliver Bennett',
                'position' => 'Head of Design, Artisan Works',
                'image'    => 'https://i.pravatar.cc/150?img=57',
                'rating'   => 4,
                'text'     => 'Nullam varius, turpis molestie pretium suscipit, quam arcu eleifend nunc. The design sensibility and attention to detail is second to none in the industry.',
            ],
        ];

        return view('testimonials', compact('testimonials'));
    }
}
