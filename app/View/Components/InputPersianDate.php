<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputPersianDate extends Component {

    public $title = null;
    public $name = null;
    public $id = null;
    public $value = null;
    public $icon = null;
    public $type = null;


    /**
     * Create a new component instance.
     *
     * @return void
     */


    public function __construct($title = null, $name = null, $id = null, $value = null, $icon = null, $type = 'text') {
        $this->title = $title;
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
        $this->icon = $icon;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.input-persian-date');
    }
}
