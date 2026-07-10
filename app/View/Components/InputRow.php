<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputRow extends Component {

    public $title = null;
    public $caption = null;
    public $name = null;
    public $id = null;
    public $value = null;
    public $icon = null;
    public $type = null;
    public $image = null;
    public $disabled = null;
    public $min = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */


    public function __construct($title = null, $caption = null, $name = null, $id = null, $value = null, $icon = null, $image = null, $type = 'text', $disabled = null, $min = null) {
        $this->title = $title;
        $this->caption = $caption;
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
        $this->icon = $icon;
        $this->image = $image;
        $this->type = $type;
        $this->disabled = $disabled;
        $this->min = $min;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.input-row');
    }
}
