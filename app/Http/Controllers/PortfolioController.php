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
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula felis vel risus tincidunt, nec fermentum enim cursus.',
            ],
            [
                'icon'        => 'fas fa-shopping-cart',
                'title'       => 'Ecommerce Solutions',
                'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus euismod turpis id.',
            ],
            [
                'icon'        => 'fas fa-chart-line',
                'title'       => 'Digital Marketing',
                'description' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.',
            ],
            [
                'icon'        => 'fas fa-code',
                'title'       => 'Web Development',
                'description' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur excepteur sint.',
            ],
        ];

        $portfolioItems = [
            [
                'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600&q=80',
                'title' => 'Luxury Watch Collection',
                'category' => 'Product Design',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?w=600&q=80',
                'title' => 'Fashion Boutique Store',
                'category' => 'Ecommerce',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=600&q=80',
                'title' => 'Sports Brand Identity',
                'category' => 'Branding',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=600&q=80',
                'title' => 'Retail Interior Concept',
                'category' => 'Interior Design',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=600&q=80',
                'title' => 'Photography Portfolio',
                'category' => 'Visual Arts',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=600&q=80',
                'title' => 'Tech Startup Website',
                'category' => 'Web Development',
            ],
        ];

        return view('portfolio.index', compact('services', 'portfolioItems'));
    }
}
