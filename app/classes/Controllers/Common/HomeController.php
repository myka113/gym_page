<?php

namespace App\Controllers\Common;

use App\Views\BasePage;
use Core\View;

class HomeController
{
    protected $page;

    /**
     * Controller constructor.
     *
     * We can write logic common for all
     * other methods
     *
     * For example, create $page object,
     * set it's header/navigation
     * or check if user has a proper role
     *
     * Goal is to prepare $page
     */
    public function __construct()
    {
        $this->page = new BasePage([
            'title' => 'Home | Golden gym',
        ]);
    }

    /**
     * Home Controller Index
     *
     * @return string|null
     * @throws \Exception
     */
    public function index(): ?string
    {
        $map_source = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2304.2194261567392!2d25.335696616278884!3d54.72335507837736!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46dd96e7d814e149%3A0xdd7887e198efd4c7!2sSaul%C4%97tekio%20al.%2015%2C%20Vilnius%2010224!5e0!3m2!1sen!2slt!4v1608570354228!5m2!1sen!2slt';

        $services = [
            [
                'image' => '/media/img/service-1.jpg',
                'title' => 'Best equipment',
                'description' => 'ularity, positive reviews, and commercial success worldwide. They have attracted a wide adult audience as well as younger readers and are often considered cornerstones of modern young adult literature'
            ],
            [
                'image' => '/media/img/service-2.jpg',
                'title' => 'Workout 24/7',
                'description' => 'gym is open 24/7! You can go at any time and not worry about working hours!'
            ],
            [
                'image' => '\media\img\service-3.jpg',
                'title' => 'Group trainings',
                'description' => 'The success of the books and films has allowed the Harry Potter franchise to expand with numerous derivative works, a travelling exhibition t'
            ],
        ];

        $content = (new View([
            'services' => $services ?? [],
            'map' => $map_source ?? '',
        ]))->render(ROOT . '/app/templates/content/index.tpl.php');

        $this->page->setContent($content);

        return $this->page->render();
    }
}

