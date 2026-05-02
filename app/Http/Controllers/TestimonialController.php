<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = [
            [
                'name'     => 'Sophia Reynolds',
                'position' => 'CEO, Luxe Interiors',
                'image'    => 'https://randomuser.me/api/portraits/women/44.jpg',
                'rating'   => 5,
                'text'     => 'Absolutely wonderful experience from start to finish. The quality of products exceeded my expectations and the customer service was impeccable. I would highly recommend this company to anyone looking for premium quality.',
            ],
            [
                'name'     => 'James Whitmore',
                'position' => 'Founder, Urban Craft Co.',
                'image'    => 'https://randomuser.me/api/portraits/men/32.jpg',
                'rating'   => 5,
                'text'     => 'I have been a loyal customer for over two years and every single order has been delivered with care and precision. The attention to detail in packaging and product quality is truly unmatched in the industry.',
            ],
            [
                'name'     => 'Amelia Chen',
                'position' => 'Marketing Director, Bloom & Co.',
                'image'    => 'https://randomuser.me/api/portraits/women/68.jpg',
                'rating'   => 4,
                'text'     => 'The collection here is unlike anything I have found elsewhere. Elegant, timeless, and beautifully crafted. My team absolutely loved the corporate gifts we ordered and our clients were thoroughly impressed.',
            ],
            [
                'name'     => 'Daniel Hartley',
                'position' => 'Creative Director, Studio Nord',
                'image'    => 'https://randomuser.me/api/portraits/men/75.jpg',
                'rating'   => 5,
                'text'     => 'From browsing the catalog to receiving my order, the entire journey was seamless and enjoyable. The products have a genuine premium feel and the brand ethos truly shines through in everything they do.',
            ],
            [
                'name'     => 'Isabella Moreau',
                'position' => 'Head of Procurement, Maison Elite',
                'image'    => 'https://randomuser.me/api/portraits/women/12.jpg',
                'rating'   => 5,
                'text'     => 'We source exclusively from this brand for our boutique hotel properties. Our guests consistently remark on the quality and elegance. It is rare to find a supplier that delivers this level of consistency every time.',
            ],
            [
                'name'     => 'Oliver Bennett',
                'position' => 'Operations Manager, Heritage Group',
                'image'    => 'https://randomuser.me/api/portraits/men/54.jpg',
                'rating'   => 4,
                'text'     => 'Superb quality and a refreshingly smooth ordering process. The team was responsive, professional, and went above and beyond to accommodate our custom requirements. Will definitely be ordering again very soon.',
            ],
        ];

        return view('testimonials', compact('testimonials'));
    }
}
