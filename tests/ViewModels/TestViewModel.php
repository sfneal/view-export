<?php

namespace Sfneal\ViewExport\Tests\ViewModels;

use Sfneal\ViewModels\AbstractViewModel;

class TestViewModel extends AbstractViewModel
{
    /**
     * TestViewModel constructor.
     *
     * @param string $view
     */
    public function __construct(string $view = 'test')
    {
        $this->view = $view;
    }

    /**
     * Return a string.
     *
     * @return string
     */
    public function string(): string
    {
        return "Here's a string!";
    }

    /**
     * @return array[]
     */
    public function data(): array
    {
        return [
            [
                'player' => 'Mario Lemieux',
                'team' => 'PIT',
                'gp' => 70,
                'g' => 69,
                'a' => 92,
            ],
            [
                'player' => 'Jaromir Jagr',
                'team' => 'PIT',
                'gp' => 82,
                'g' => 62,
                'a' => 87,
            ],
            [
                'player' => 'Joe Sakic',
                'team' => 'COL',
                'gp' => 82,
                'g' => 51,
                'a' => 69,
            ],
            [
                'player' => 'Ron Francis',
                'team' => 'PIT',
                'gp' => 77,
                'g' => 27,
                'a' => 92,
            ],
            [
                'player' => 'Peter Forsberg',
                'team' => 'COL',
                'gp' => 82,
                'g' => 30,
                'a' => 86,
            ],
        ];
    }
}
