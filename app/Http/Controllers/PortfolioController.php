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
        // Portfolio data - can be moved to database later
        $data = [
            'company_name' => 'Elevating Your Ecommerce Experience',
            'tagline' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'services' => [
                [
                    'icon' => '🎨',
                    'title' => 'Product Design',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut enim ad minim veniam, quis nostrud exercitation.'
                ],
                [
                    'icon' => '🛒',
                    'title' => 'Ecommerce Solutions',
                    'description' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'
                ],
                [
                    'icon' => '📱',
                    'title' => 'Digital Marketing',
                    'description' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim.'
                ],
                [
                    'icon' => '💡',
                    'title' => 'Brand Strategy',
                    'description' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.'
                ]
            ],
            'portfolio_items' => [
                [
                    'image' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=500',
                    'title' => 'Fashion Collection'
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?w=500',
                    'title' => 'Boutique Store'
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=500',
                    'title' => 'Retail Excellence'
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=500',
                    'title' => 'Product Showcase'
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=500',
                    'title' => 'Modern Design'
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=500',
                    'title' => 'Premium Quality'
                ]
            ]
        ];

        return view('portfolio.index', $data);
    }
}
