<?php

namespace App\Livewire;

use App\Models\Attach;
use App\Models\Folder;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class Files extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $id,$attach;
    public $filesMultiple = [];

    public function mount($id)
    {
        $this->id = $id;
    }

    public function uploadFile()
    {




        $this->validate([
            'filesMultiple.*' => 'required|file|max:10000000',
        ]);



        foreach ($this->filesMultiple as $file) {
            $filePath = $file->store('uploads', 'public');

            // Save to the attach table
            Attach::create([
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $filePath,
                'folder_id' => $this->id
            ]);
        }


        toastr()->success('Data has been saved successfully!');

        $this->reset('filesMultiple');

        // Refresh the list of processes
        $this->attach = Attach::all();


    }


    public function deleteFile($fileId)
    {
        $id = $this->id;
        $file = Attach::find($fileId);

        if ($file) {
            // Construct the path relative to 'storage/app/public'

            $filePath = 'public/' . $file->file_path;

            // dd($filePath);

            if (Storage::exists($filePath)) {
                // Delete the file from storage
                Storage::delete($filePath);
                $file->delete();
                toastr()->success('File deleted successfully.');
            } else {
                toastr()->error('File not found in storage.');
            }

            return redirect()->to(route('file', ['folder' => $id]));
        } else {
            toastr()->error('File record not found.');
            return redirect()->to(route('file', ['folder' => $id]));
        }
    }


    public function render()
    {
        $folder = Folder::find($this->id);


            if (!$folder) {
                abort(404, 'MainProccess not found.');
            }

            $files = Attach::where('folder_id', $this->id)
                                            ->orderByDesc('created_at')
                                            ->paginate(16);

            $note = $folder->note;




            return view('livewire.files', [
                'files' => $files,
                'note' => $note
            ]);


    }
}
