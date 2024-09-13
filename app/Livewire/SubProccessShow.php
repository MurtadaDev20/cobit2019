<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SubProccess as ModelsSubProccess;
class SubProccessShow extends Component
{

    public function SubProccessDelete($procId)
{

    $proce = ModelsSubProccess::find($procId);
    if (!$proce) {
        toastr()->error('Sub Process not found.');
        return redirect()->to(route('mainProccess'));
    }

    if ($proce->attach()->count() > 0) {
        toastr()->error('Cannot delete Sub Process. It contains a Files.');
        return redirect()->to(route('subProccessAll'));
    }


    $proce->delete();
    toastr()->success('Sub Process deleted successfully.');
    return redirect()->to(route('subProccessAll'));
}
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
