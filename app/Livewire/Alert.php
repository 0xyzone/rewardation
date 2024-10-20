<?php

namespace App\Livewire;

use Livewire\Component;

class Alert extends Component
{
    public $name;
    public $email;
    public $amount;

    protected $listeners = ['rewardSubmitted'];

    public function rewardSubmitted($data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->amount = $data['amount'];
    }
    public function render()
    {
        return view('livewire.alert');
    }
}
