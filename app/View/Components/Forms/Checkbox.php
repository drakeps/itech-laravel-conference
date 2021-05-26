<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Checkbox extends Component
{
    public $name;
    public $label;
    public $value;
    public $checked;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $value = '', $label = '', $checked = false)
    {
        $this->name    = $name;
        $this->value   = $value;
        $this->label   = $label;
        $this->checked = $checked;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.checkbox');
    }

    public function getId()
    {
        return 'checkbox-' . $this->name;
    }
}
