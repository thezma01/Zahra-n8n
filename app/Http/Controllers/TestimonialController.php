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
                'position' => 'CEO, Luxe Retail Co.',
                'image'    => 'https://randomuser.me/api/portraits/women/44.jpg',
                'rating'   => 5,
                'text'     => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula felis nec nisl tincidunt, at fermentum libero consequat. The service exceeded every expectation we had — truly world-class.',
            ],
            [
                'name'     => 'James Hartwell',
                'position' => 'Founder, Nova Trends',
                'image'    => 'https://randomuser.me/api/portraits/men/32.jpg',
                'rating'   => 5,
                'text'     => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Working with this team transformed our brand presence completely.',
            ],
            [
                'name'     => 'Amelia Chen',
                'position' => 'Marketing Director, Bloom Studios',
                'image'    => 'https://randomuser.me/api/portraits/women/68.jpg',
                'rating'   => 4,
                'text'     => 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae. Their attention to detail and creative approach made all the difference for our campaigns.',
            ],
            [
                'name'     => 'Daniel Mercer',
                'position' => 'COO, UrbanEdge Group',
                'image'    => 'https://randomuser.me/api/portraits/men/54.jpg',
                'rating'   => 5,
                'text'     => 'Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis molestie dictum semper, metus mauris commodo tellus. Exceptional results, delivered on time every single time.',
            ],
            [
                'name'     => 'Isabella Torres',
                'position' => 'Head of Design, Velvet Lane',
                'image'    => 'https://randomuser.me/api/portraits/women/22.jpg',
                'rating'   => 5,
                'text'     => 'Donec aliquet, tortor sed accumsan bibendum, erat ligula aliquet magna, vitae ornare odio metus a mi. The premium quality of work speaks for itself — absolutely outstanding.',
            ],
            [
                'name'     => 'Oliver Bennett',
                'position' => 'Product Manager, Sphere Digital',
                'image'    => 'https://randomuser.me/api/portraits/men/76.jpg',
                'rating'   => 4,
                'text'     => 'Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. A seamless experience from start to finish — highly recommend to any growing business.',
            ],
        ];

        return view('testimonials', compact('testimonials'));
    }
}
