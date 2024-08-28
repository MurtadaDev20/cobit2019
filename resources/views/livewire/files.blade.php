<div>
    <div>
        <div class="row">
            <div class="col-md-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        {{-- <h5 class="card-title">{{ $subName }}</h5> --}}

                        <form wire:submit.prevent="uploadFile">
                            <div class="mb-3">
                                <label class="form-label">Add Files</label>
                                <input type="file" class="form-control" wire:model="filesMultiple" multiple>
                                @error('filesMultiple') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div wire:loading wire:target="filesMultiple">Uploading...</div>
                            <br>
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">Upload file</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    {{-- ======================================================proccesses Detiles==================================================== --}}

    <div class="row">
        <div class="col-sm-6 mb-4" >
            <h4 class="mb-0"> Note </h4>
        </div>
        <div class="col-md-12 mb-30">
          <div class="card card-statistics h-100">
            <div class="card-body">
              <div class="card-body">
                <p class="card-title">
                  {{$note}}
                </p>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="row">

        @foreach($files as $file)
        <div class="col-sm-6 col-lg-6 col-xl-3 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <h5 class="mt-15 mb-15"><b>{{ $file->file_name }}</b></h5>

                    <div class="row">
                        <div class="col-12 col-sm-12 mt-30">
                            <div class="card-body">
                                <button class="button button-border x-small" title="Delete" data-toggle="modal" data-target="#deleteModal-{{ $file->id }}"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Modal -->
            <div class="modal fade" id="deleteModal-{{ $file->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete File</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this file?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button wire:click.prevent="deleteFile({{ $file->id }})" type="button" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

      </div>
      {{$files->links()}}
      </div>

</div>
