<?php

namespace App\View\Components\Form;

class Select extends Field
{
    /**
     * The select options.
     *
     * @var mixed
     */
    public $options;
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
    public function __construct($name, $label, $options, $default = null)
    {
        parent::__construct($name, $label);

        $this->default = $default;
        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.select');
    }
}
