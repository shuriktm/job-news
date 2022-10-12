<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Form extends Component
{
    /**
     * The form action.
     *
     * @var mixed
     */
    public $action;
    /**
     * The request method.
     *
     * @var string
     */
    public $method;
    /**
     * The button text.
     *
     * @var string
     */
    public $button;


    /**
     * Create a new component instance.
     *
     * @param  mixed  $rows
     * @return void
     */
    public function __construct($action, $button, $method = null)
    {
        $this->action = $action;
        $this->button = $button;
        $this->method = $method;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form');
    }
}
