<?php

namespace App\View\Components;

use Illuminate\View\Component;
use function view;

class ChartRequests extends Component {

    public $permission;

    public function __construct( $permission = null) {
        $this->permission = $permission;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.dashboard.chart-requests');
    }
}
