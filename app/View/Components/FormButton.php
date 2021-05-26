<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormButton extends Component
{
    public $method;
    public $actionUrl;
    public $style;
    public $icon;

    public function __construct($method, $actionUrl, $style = '', $icon = '')
    {
        $this->method    = $method;
        $this->actionUrl = $actionUrl;
        $this->style     = $style;
        $this->icon      = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-button');
    }
}
