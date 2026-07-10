<?php

namespace App\View\Components;

use Illuminate\View\Component;
use function view;

class CountBox extends Component {

    public $permission;
    public $url;
    public $icon;
    public $title;
    public $caption;
    public $color;

    public function __construct($url = null, $icon = null, $permission = null, $caption = null, $title = null, $color = null) {
        $this->permission = $permission;
        $this->url = $url;
        $this->icon = $icon;
        $this->title = $title;
        $this->caption = $caption;
        $this->color = $color;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.dashboard.count-box');
    }
}
