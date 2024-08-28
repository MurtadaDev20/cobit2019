<?php

namespace App\Livewire;

use App\Models\MainProccess as ModelsMainProccess;
use Livewire\Component;
use Livewire\WithPagination;

class MainProccess extends Component
{
    use WithPagination;
    public $name, $desc, $proccessess;

    public function addProccess()
    {

        // Validate
        $this->validate([
            'name' => 'required|string|min:3|max:255|unique:main_proccesses',
            'desc' => 'required|string|min:10|max:1000',
        ]);


        ModelsMainProccess::create([
            'name' => $this->name,
            'desc' => $this->desc
        ]);


        toastr()->success('Data has been saved successfully!');


        $this->reset('name', 'desc');

        // Refresh the list of processes
        $this->proccessess = ModelsMainProccess::all();
    }


    //Delete

    public function MainProccessDelete($procId)
    {
        $proce = ModelsMainProccess::find($procId);

        if (!$proce) {
            toastr()->error('Main Process not found.');
            return redirect()->to(route('mainProccess'));
        }

        if ($proce->subProccess()->count() > 0) {
            toastr()->error('Cannot delete Main Process. It contains a Sub Process.');
            return redirect()->to(route('mainProccess'));
        }

        $proce->delete();
        toastr()->success('Main Process deleted successfully.');
        return redirect()->to(route('mainProccess'));
    }

    // View

    public function render()
    {
        $proccesses = ModelsMainProccess::with('subProccess')
            ->orderByDesc('created_at')
            ->paginate(16);

        return view('livewire.main-proccess', [
            'proccesses' => $proccesses,
        ]);
    }
}
