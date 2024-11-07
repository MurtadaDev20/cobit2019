<?php

namespace App\Livewire;

use App\Models\Attach;
use App\Models\Comment;
use App\Models\SubProccess;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class Files extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $id,$attach,$rate,$content;
    public $filesMultiple = [];
    public $comments = [];

    public function mount($id)
    {
        $this->id = $id;
        $this->loadComments();
    }
// End Function
    public function uploadFile()
    {

        $this->validate([
            'filesMultiple.*' => 'required|file|max:10000000',
        ]);



        foreach ($this->filesMultiple as $file) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            // Save to the attach table
            Attach::create([
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $filePath,
                'subp_id' => $this->id
            ]);
        }


        toastr()->success('Data has been saved successfully!');

        $this->reset('filesMultiple');

        // Refresh the list of processes
        $this->attach = Attach::all();


    }
// End Function

    public function rateSubProccess()
    {

        $subProccess = SubProccess::where('id',$this->id)->first();
        $subProccess->rate = $this->rate;
        $subProccess->save();
    }

// End Function


public function downloadFile($fileId)
    {
        $file = Attach::findOrFail($fileId);
        $filePath = storage_path('app/public/' . $file->file_path);
        return response()->download($filePath);
    }

    public function viewPdf($fileId)
    {
        $file = Attach::findOrFail($fileId);
        $filePath = storage_path('app/' . $file->file);

        // $this->fileContent = base64_encode(file_get_contents($filePath));
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

            return redirect()->to(route('file', ['subProccess' => $id]));
        } else {
            toastr()->error('File record not found.');
            return redirect()->to(route('file', ['subProccess' => $id]));
        }
    }
// End Function

public function loadComments()
    {
        $this->comments = Comment::where('supP_id', $this->id)
                                 ->orderByDesc('created_at')
                                 ->get();
    }


public function storeComment()
    {
        $this->validate([
            'content' => 'required|string',
        ]);
        $userId = Auth::user()->id;
        Comment::create([
            'user_id' => $userId,
            'supP_id' => $this->id,
            'content' => $this->content,
        ]);

        $this->content = '';
        $this->loadComments();

        toastr()->success( 'Comment added successfully.');
    }

    public function render()
    {
        $subProccess = SubProccess::find($this->id);


            if (!$subProccess) {
                abort(404, 'MainProccess not found.');
            }

            $files = Attach::where('subp_id', $this->id)
                                            ->orderByDesc('created_at')
                                            ->paginate(16);

            $note = $subProccess->note;
            $descr = $subProccess->desc;




            return view('livewire.files', [
                'files' => $files,
                'descr' => $descr,
                'note' => $note,
                'comments' => $this->comments,
            ]);


    }
    // End Function
}
