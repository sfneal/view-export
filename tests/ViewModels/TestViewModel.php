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
}
