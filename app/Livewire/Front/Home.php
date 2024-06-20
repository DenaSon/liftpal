<?php
namespace App\Livewire\Front;


use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Phpml\Classification\KNearestNeighbors;

class Home extends Component
{
    use LivewireAlert;
    public $search = '';

    public function ai()
    {
        $samples = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
        $labels = ['red', 'red', 'red', 'green', 'green', 'green'];
        $classifier = new KNearestNeighbors();
        $classifier->train($samples, $labels);

        $this->alert('success', $classifier->predict([3, 3]));

    }

    public function render()
    {

        $title = getSetting('website_title') ?? 'LiftPal';
        return view('livewire.front.home')->title($title);

    }
}
