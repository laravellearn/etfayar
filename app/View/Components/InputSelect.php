<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputSelect extends Component {

    public $title = null;
    public $name = null;
    public $id = null;
    public $items = null;
    public $value = null;
    public $valueKey = null;
    public $key = null;
    public $icon = null;
    public $isAddFirst = null;
    public $disabled = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = null, $name = null, $id = null, $items = null, $value = null, $valueKey = null,$key = 'title', $icon = null, $isAddFirst = false, $disabled = null) {
        $this->title = $title;
        $this->name = $name;
        $this->id = $id;
        $this->items = $items;
        $this->value = $value;
        $this->valueKey = $valueKey;
        $this->key = $key;
        $this->icon = $icon;
        $this->isAddFirst = $isAddFirst;
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.input-select');
    }
}
