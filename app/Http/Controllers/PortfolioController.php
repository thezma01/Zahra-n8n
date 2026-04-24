<?php

namespace App\Http\Controllers;

class PortfolioController extends Controller
{
    /**
     * Display the company portfolio page.
     */
    public function index()
    {
        $services = [
            [
                'icon'        => 'fas fa-paint-brush',
                'title'       => 'Product Design',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            ],
            [
                'icon'        => 'fas fa-shopping-cart',
                'title'       => 'Ecommerce Solutions',
                'description' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            ],
            [
                'icon'        => 'fas fa-chart-line',
                'title'       => 'Digital Marketing',
                'description' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
            ],
            [
                'icon'        => 'fas fa-code',
                'title'       => 'Web Development',
                'description' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            ],
        ];

        $portfolioItems = [
            [
                'image' => 'https://picsum.photos/seed/port1/600/400',
                'title' => 'Luxury Brand Redesign',
                'category' => 'Branding',
            ],
            [
                'image' => 'https://picsum.photos/seed/port2/600/400',
                'title' => 'Fashion Ecommerce Store',
                'category' => 'Ecommerce',
            ],
            [
                'image' => 'https://picsum.photos/seed/port3/600/400',
                'title' => 'Product Packaging',
                'category' => 'Design',
            ],
            [
                'image' => 'https://picsum.photos/seed/port4/600/400',
                'title' => 'Mobile Shopping App',
                'category' => 'Development',
            ],
            [
                'image' => 'https://picsum.photos/seed/port5/600/400',
                'title' => 'Marketing Campaign',
                'category' => 'Marketing',
            ],
            [
                'image' => 'https://picsum.photos/seed/port6/600/400',
                'title' => 'Corporate Identity',
                'category' => 'Branding',
            ],
        ];

        return view('portfolio.index', compact('services', 'portfolioItems'));
    }
}
