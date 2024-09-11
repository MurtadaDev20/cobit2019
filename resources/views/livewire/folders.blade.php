<div>
    <div>
        @if (Auth::user()->role_id == 2)

        @else
        <div class="row">
          <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
              <div class="card-body">
                <div class="card-body">
                  <h5 class="card-title">
                    {{$subName}}
                  </h5>

                  <form >
                    {{-- Add  --}}
                    <div class="mb-3">
                      <label class="form-label" for="exampleInputEmail1">Folder Name</label>
                      <input wire:model="name" type="text" class="form-control" aria-describedby="emailHelp">
                      {{-- error text  --}}
                      @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                      <label class="form-label" for="exampleInputEmail1">Note</label>
                      <textarea wire:model="note" type="text" class="form-control" aria-describedby="emailHelp"  rows="3"></textarea>
                      {{-- error text  --}}
                      @error('note') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>


                    {{-- Edit --}}


                    <button wire:click.prevent="addFolder" wire:loading.class='btn btn-danger'  wire:loading.attr='disabled' type="submit" class="btn btn-primary">Add</button>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif

    {{-- ======================================================proccesses Detiles==================================================== --}}
    <div class="row">
        <div class="col-sm-6 mb-4" >

        </div>
        <div class="col-md-12 mb-30">
          <div class="card card-statistics h-100">
            <div class="card-body">
                <h4 class="mb-0"> Desecription </h4>
                <hr>
              <div class="card-body">

                <p class="card-title">
                  {{ $descr }}
                </p>
              </div>
            </div>
          </div>
        </div>
    </div>
      <div class="row">
        @foreach($folders as $folder)
        <div class="col-sm-6 col-lg-6 col-xl-3 mb-30">
            <div class="card card-statistics h-100">
              <div class="card-body">
                <a href="{{route('file',$folder->id)}}" class="text-dark float-end" data-bs-toggle="tooltip" data-bs-placement="left" title=""
                    data-bs-original-title="View project"><i class="fa fa-eye"></i> <span>Show Files</span> </a>
                <h5 class="mt-15 mb-15"><b>Sub Proccess Name : {{ $folder->name }}</b></h5>
                <div class="row">
                  <div class="col-12 col-sm-12 mt-20">
                    <b>Files </b>
                    <h4 class="text-success mt-10">{{$folder->attach->count()}}</h4>

                  </div>
                </div>

                @if (Auth::user()->role_id == 2 )

                @else
                <div class="row">
                  <div class="col-12 col-sm-12 mt-30">
                    <div class="card-body">
                      <a  class="button button-border x-small"href="#" title="Edit"><i class="fa fa-edit"></i></a>
                        <button class="button button-border x-small"  title="Delete" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></button>

                   <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            Are you sure you want to delete this File?
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button wire:click="FolderDelete({{ $folder->id }})" type="button"
                                                class="btn btn-danger">Delete</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                    </div>
                  </div>
                </div>
                @endif
              </div>
            </div>
          </div>

        {{-- @endif --}}


        @endforeach

      </div>
      <div class="m-4">
        {{$folders->links()}}
      </div>


      </div>

</div>
