<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display the portfolio page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Portfolio data
        $portfolioData = [
            'hero' => [
                'title' => 'Elevating Your Ecommerce Experience',
                'tagline' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'image' => 'https://st-gdx.dancf.com/gaodingx/0/uxms/design/20210122-101837-cf22.png'
            ],
            'about' => [
                'title' => 'About Our Company',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'mission' => 'Our mission is to deliver exceptional ecommerce solutions that transform businesses. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                'vision' => 'We envision a world where every business can thrive online. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'image' => 'https://img.freepik.com/premium-photo/clothing-boutique-banner-mockup-with-blank-white-empty-space-placing-your-design_839035-1577676.jpg'
            ],
            'services' => [
                [
                    'title' => 'Product Design',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore.',
                    'icon' => '🎨'
                ],
                [
                    'title' => 'Ecommerce Solutions',
                    'description' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.',
                    'icon' => '🛒'
                ],
                [
                    'title' => 'Brand Strategy',
                    'description' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla.',
                    'icon' => '📊'
                ],
                [
                    'title' => 'Digital Marketing',
                    'description' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim.',
                    'icon' => '📱'
                ]
            ],
            'portfolio_items' => [
                [
                    'title' => 'Modern Fashion Store',
                    'image' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800&q=80'
                ],
                [
                    'title' => 'Luxury Accessories',
                    'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=800&q=80'
                ],
                [
                    'title' => 'Lifestyle Collection',
                    'image' => 'https://images.unsplash.com/photo-1472851294608-062f824d29cc?w=800&q=80'
                ],
                [
                    'title' => 'Tech & Gadgets',
                    'image' => 'https://images.unsplash.com/photo-1468495244123-6c6c332eeece?w=800&q=80'
                ],
                [
                    'title' => 'Home Decor',
                    'image' => 'https://images.unsplash.com/photo-1513694203232-719a280e022f?w=800&q=80'
                ],
                [
                    'title' => 'Beauty & Wellness',
                    'image' => 'https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=800&q=80'
                ]
            ]
        ];

        return view('portfolio.index', compact('portfolioData'));
    }
}
