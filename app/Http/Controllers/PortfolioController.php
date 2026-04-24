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
                'icon'        => 'fas fa-chart-line',
                'title'       => 'Digital Marketing',
                'description' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur excepteur sint occaecat.',
            ],
            [
                'icon'        => 'fas fa-mobile-alt',
                'title'       => 'Mobile Development',
                'description' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum sed perspiciatis.',
            ],
        ];

        $portfolioItems = [
            [
                'image' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=600&h=400&fit=crop',
                'title' => 'Fashion Boutique',
                'category' => 'Ecommerce',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1472851294608-062f824d29cc?w=600&h=400&fit=crop',
                'title' => 'Luxury Brand Store',
                'category' => 'Branding',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=600&h=400&fit=crop',
                'title' => 'Home Decor Shop',
                'category' => 'Design',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1555529669-e69e7aa0ba9a?w=600&h=400&fit=crop',
                'title' => 'Accessories Collection',
                'category' => 'Ecommerce',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600&h=400&fit=crop',
                'title' => 'Watch Retailer',
                'category' => 'Retail',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=600&h=400&fit=crop',
                'title' => 'Sports Brand',
                'category' => 'Branding',
            ],
        ];

        return view('portfolio.index', compact('services', 'portfolioItems'));
    }
}
