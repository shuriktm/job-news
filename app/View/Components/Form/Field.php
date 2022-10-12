<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Field extends Component
{
    /**
     * The attribute name.
     *
     * @var mixed
     */
    public $name;
    /**
     * The attribute label.
     *
     * @var mixed
     */
    public $label;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label)
    {
        $this->name = $name;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.field');
    }
}
