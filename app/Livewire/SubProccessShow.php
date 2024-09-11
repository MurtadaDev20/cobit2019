<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SubProccess as ModelsSubProccess;
class SubProccessShow extends Component
{
    public function render()
    {
        $subProccesses = ModelsSubProccess::orderByDesc('created_at')
                                            ->with('mainProccess')
                                            ->paginate(16);

        return view('livewire.sub-proccess-show',[
            'subProccesses' => $subProccesses,
        ]);
    }
}
