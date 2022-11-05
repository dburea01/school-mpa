<?php
namespace App\View\Components;

use Illuminate\View\Component;

class GroupTabs extends Component
{
    public $activeTab;

    public $groupId;

    public $newGroup;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($activeTab, $groupId, $newGroup)
    {
        $this->activeTab = $activeTab;
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
