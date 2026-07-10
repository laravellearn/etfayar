<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component {

    public $permission;
    public $title;
    public $url;
    public $icon;
    public $btnClass;
    public $click;


    public function __construct($title, $url, $permission = null, $icon = null, $btnClass = null, $click = null) {
        $this->permission = $permission;
        $this->title = $title;
        $this->url = $url;
        $this->icon = $icon;
        $this->btnClass = $btnClass;
        $this->click = $click;
    }


    public function render() {
        return view('components.button');
    }
}
