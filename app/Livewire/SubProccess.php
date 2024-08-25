<?php

namespace App\Livewire;

use App\Models\MainProccess;
use App\Models\SubProccess as ModelsSubProccess;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

use function Laravel\Prompts\error;

class SubProccess extends Component
{
    use WithPagination;
    public $name, $desc, $proccessess , $id_after;
    public $id;


    // The mount method captures the ID when the component is initialized
    public function mount($id)
    {
        $this->id = $id;
    }

    public function addSubProccess()
    {


        $this->validate([
            'name' => 'required|string|min:3|max:255',
            'desc' => 'required|string|min:10|max:1000',
        ]);

        // dd($this->id);
        ModelsSubProccess::create([
            'name' => $this->name,
            'desc' => $this->desc,
            'mainp_id' => $this->id
        ]);


        toastr()->success('Data has been saved successfully!');

        $this->reset('name', 'desc');

        // Refresh the list of processes
        $this->proccessess = ModelsSubProccess::all();


    }






    ////////// view //////////
    public function render()
    {




            $mainProccess = MainProccess::find($this->id);


            if (!$mainProccess) {
                abort(404, 'MainProccess not found.');
            }

            $subProccesses = ModelsSubProccess::where('mainp_id', $this->id)
                                            ->orderByDesc('created_at')
                                            ->with('mainProccess')
                                            ->paginate(16);

            $mainName = $mainProccess->name;




    return view('livewire.sub-proccess', [
        'subProccesses' => $subProccesses,
        'mainName' => $mainName
    ]);
    }
}
