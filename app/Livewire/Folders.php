<?php

namespace App\Livewire;

use App\Models\Attach;
use App\Models\Folder;
use App\Models\SubProccess;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Folders extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $name , $note , $folders_ref;
    public $id;



    public function mount($id)
    {
        $this->id = $id;
    }


    public function addFolder()
    {




        $this->validate([
            'name' => 'required|string|min:3|max:255',
            'note' => 'required|string|min:10|max:1000'
        ]);


        $folder = Folder::create([
            'name' => $this->name,
            'note' => $this->note,
            'subp_id' => $this->id,
        ]);





        toastr()->success('Data has been saved successfully!');

        $this->reset('name', 'note');

        // Refresh the list of processes
        $this->folders_ref = Folder::all();


    }


    // Delete

    public function FolderDelete($foldId)
    {
        $id = $this->id;
        $folder = Folder::find($foldId);

        if (!$foldId) {
            toastr()->error('Folder not found.');
            return redirect()->to(route('folder',['SubProcess' => $id]));
        }

        if ($folder->attach()->count() > 0) {
            toastr()->error('Cannot delete Folder. It contains a Files.');
            return redirect()->to(route('folder',['SubProcess' => $id]));
        }


        $folder->delete();
        toastr()->success('Folder deleted successfully.');
        return redirect()->to(route('folder', ['SubProcess' => $id]));
    }


    ////////// view //////////
    public function render()
    {
            $subproccess = SubProccess::find($this->id);


            if (!$subproccess) {
                abort(404, 'MainProccess not found.');
            }

            $folders = Folder::where('subp_id', $this->id)
                                            ->orderByDesc('created_at')
                                            ->paginate(16);

            $subName = $subproccess->name;
            $descr = $subproccess->desc;




    return view('livewire.folders', [
        'folders' => $folders,
        'descr' => $descr,
        'subName' => $subName
    ]);
    }
}
