<div>
    <div>
        @if (Auth::user()->role_id == 2)
        <div class="row">
            <div class="col-md-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        {{-- <h5 class="card-title">{{ $subName }}</h5> --}}

                        <form wire:submit.prevent="rateSubProccess">
                            <div class="mb-3">
                                <label class="form-label">Rate Files From 5</label>

                                <select wire:model="rate" class="form-control p-2" id="inlineFormSelectPref">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                @error('rate') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Rate</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @else
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
        @endif
    {{-- ======================================================proccesses Detiles==================================================== --}}

    <div class="row">
        <div class="col-sm-6 mb-4" >

        </div>
        <div class="col-md-12 mb-30">
          <div class="card card-statistics h-100">

            <div class="card-body">
                <div class="card-body">

                    <div class="accordion gray plus-icon round">
                        <div class="acd-group">
                            <a href="#" class="acd-heading">Desecription</a>
                            <div class="acd-des" style="display: none;">{{ $descr }}</div>
                        </div>
                        <div class="acd-group">
                            <a href="#" class="acd-heading">Note</a>
                            <div class="acd-des" style="display: none;">{{ $note }}</div>
                        </div>
                    </div>
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

                    <img class="img-fluid mb-20" src="{{asset('assets/images/file-icon/PDF.png')}}" alt="">
                    <div class="d-block d-md-flex justify-content-between">
                        <div class="d-block">
                            <p class="mt-15 mb-15"><b>{{ $file->file_name }}</b></p>
                          </div>
                          <div class="d-block d-md-flex">
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-outline-success btn-sm" title="Delete" data-toggle="modal" data-target="#deleteModal-{{ $file->id }}"><i class="fa fa-trash"></i></button>
                                  {{-- Download --}}
                                  <button wire:click="downloadFile({{$file->id}})" class="btn btn-outline-success btn-sm" title="download"><i class="fa fa-download"></i></button>
                                  <button onclick="window.location.href='{{ route('viewFile', $file->id) }}'" class="btn btn-outline-success btn-sm" title="View">
                                    <i class="fa fa-eye"></i>
                                </button>
                                </div>
                            </div>
                          </div>
                    </div>



                </div>
            </div>

            @if (Auth::user()->role_id == 2 )

            @else
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
            @endif
        </div>
    @endforeach

      </div>
      {{$files->links()}}
      </div>

</div>
