<?php

namespace App\View\Components\Form;

class Text extends Field
{
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
    public function __construct($name, $label = null, $default = null)
    {
        parent::__construct($name, $label);

        $this->default = $default;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.text');
    }
}
