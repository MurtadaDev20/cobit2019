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
    public $name, $desc, $proccessess,$note ;
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
            'note' => $this->note,
            'mainp_id' => $this->id
        ]);


        toastr()->success('Data has been saved successfully!');

        $this->reset('name', 'desc');

        // Refresh the list of processes
        $this->proccessess = ModelsSubProccess::all();


    }


//Delete

public function SubProccessDelete($procId)
{
    $id = $this->id;
    $proce = ModelsSubProccess::find($procId);

    if (!$proce) {
        toastr()->error('Sub Process not found.');
        return redirect()->to(route('mainProccess'));
    }

    if ($proce->folders()->count() > 0) {
        toastr()->error('Cannot delete Sub Process. It contains a Folders.');
        return redirect()->to(route('subProccess',['process' => $id]));
    }


    $proce->delete();
    toastr()->success('Sub Process deleted successfully.');
    return redirect()->to(route('subProccess', ['process' => $id]));
}




    ////////// view //////////
    public function render()
    {


        $mainName = null;
        $descr = null;

            $mainProccess = MainProccess::find($this->id);


            if ($mainProccess) {
                $subProccesses = ModelsSubProccess::where('mainp_id', $this->id)
                                            ->orderByDesc('created_at')
                                            ->with('mainProccess')
                                            ->paginate(16);

                $mainName = $mainProccess->name;

                $descr = $mainProccess->desc;
            } else {
                $subProccesses = ModelsSubProccess::orderByDesc('created_at')
                                            ->with('mainProccess')
                                            ->paginate(16);
            }



    return view('livewire.sub-proccess', [
        'subProccesses' => $subProccesses,
        'descr' => $descr,
        'mainName' => $mainName,

    ]);
    }



}
