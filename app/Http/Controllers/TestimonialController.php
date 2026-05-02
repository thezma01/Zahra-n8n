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
                'position' => 'CEO, Luxe Boutique',
                'rating'   => 5,
                'image'    => 'https://i.pravatar.cc/150?img=47',
                'text'     => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula felis vel urna tincidunt, at dapibus nisi pharetra. Exceptional quality and outstanding service every single time.',
            ],
            [
                'name'     => 'James Harrington',
                'position' => 'Founder, StyleHub',
                'rating'   => 5,
                'image'    => 'https://i.pravatar.cc/150?img=12',
                'text'     => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Truly a premium experience that exceeded all of my expectations.',
            ],
            [
                'name'     => 'Amelia Chen',
                'position' => 'Marketing Director, TrendCo',
                'rating'   => 4,
                'image'    => 'https://i.pravatar.cc/150?img=32',
                'text'     => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation. The attention to detail is simply remarkable.',
            ],
            [
                'name'     => 'Oliver Martinez',
                'position' => 'CTO, ModernWear',
                'rating'   => 5,
                'image'    => 'https://i.pravatar.cc/150?img=15',
                'text'     => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Best investment our company has made this year.',
            ],
            [
                'name'     => 'Isabella Thompson',
                'position' => 'Head of Design, Elegance Co.',
                'rating'   => 5,
                'image'    => 'https://i.pravatar.cc/150?img=56',
                'text'     => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. A seamless and delightful experience throughout.',
            ],
            [
                'name'     => 'Ethan Williams',
                'position' => 'Product Manager, UrbanEdge',
                'rating'   => 4,
                'image'    => 'https://i.pravatar.cc/150?img=3',
                'text'     => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores. The platform delivers exactly what it promises.',
            ],
        ];

        return view('testimonials', compact('testimonials'));
    }
}
