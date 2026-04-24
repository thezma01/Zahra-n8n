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
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ut enim.',
            ],
            [
                'icon'        => 'fas fa-shopping-cart',
                'title'       => 'Ecommerce Solutions',
                'description' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat duis aute.',
            ],
            [
                'icon'        => 'fas fa-bullhorn',
                'title'       => 'Digital Marketing',
                'description' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur excepteur sint occaecat.',
            ],
            [
                'icon'        => 'fas fa-code',
                'title'       => 'Web Development',
                'description' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum sed perspiciatis.',
            ],
        ];

        $portfolioItems = [
            [
                'image' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=600&q=80',
                'title' => 'Fashion Collection',
                'category' => 'Ecommerce',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600&q=80',
                'title' => 'Luxury Watches',
                'category' => 'Product Design',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1567401893414-76b7b1e5a7a5?w=600&q=80',
                'title' => 'Boutique Store',
                'category' => 'Branding',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=600&q=80',
                'title' => 'Online Marketplace',
                'category' => 'Web Development',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?w=600&q=80',
                'title' => 'Lifestyle Brand',
                'category' => 'Digital Marketing',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=600&q=80',
                'title' => 'Sports Collection',
                'category' => 'Product Design',
            ],
        ];

        return view('portfolio.index', compact('services', 'portfolioItems'));
    }
}
