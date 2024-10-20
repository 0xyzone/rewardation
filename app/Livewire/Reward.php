<?php

namespace App\Livewire;

use Livewire\Component;

class Reward extends Component
{
    public $name;
    public $email;
    public $amount;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'amount' => 'required|numeric',
    ];

    public function submit()
    {
        $this->validate();
        // dd('Event emitted', $this->name, $this->email, $this->amount);

        // Emit the event with the submitted data
        $this->emitTo('alert','rewardSubmitted', [
            'name' => $this->name,
            'email' => $this->email,
            'amount' => $this->amount,
        ]);

        // Optionally, you can clear the form after submission
        $this->reset(['name', 'email', 'amount']);
    }
    public function render()
    {
        return view('livewire.reward');
    }
}
