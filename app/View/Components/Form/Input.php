<?php

namespace App\View\Components\Form;

class Input extends Field
{
    /**
     * The input type.
     *
     * @var mixed
     */
    public $type;
    /**
     * The default value.
     *
     * @var mixed
     */
    public $default;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label = null, $default = null, $type = 'text')
    {
        parent::__construct($name, $label);

        $this->default = $default;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.input');
    }
}
