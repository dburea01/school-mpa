<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GroupTabs extends Component
{
    public $activeTab;
    public $schoolId;
    public $groupId;
    public $newGroup;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($activeTab, $schoolId, $groupId, $newGroup)
    {
        $this->activeTab = $activeTab;
        $this->schoolId = $schoolId;
        $this->groupId = $groupId;
        $this->newGroup = $newGroup;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.group-tabs');
    }
}
