@extends('layouts.base')
@section('body')
  <div class="container">
    @if ( Session::has('success'))
      <div class="alert alert-success">
        <p>{{ Session::get('success') }}</p>
      </div><br />
     @endif
    <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#petModal">Add New Pet</button> -->

<!--     <button type="button" class="btn btn-success" data-toggle="modal" data-target="#emailModal">Contact Us
    </button> -->

<div class="col-xs-6">
      <form method="post" enctype="multipart/form-data" action="{{route('petImport')}}">
         @csrf
       <input type="file" id="uploadName" name="pet_upload" required>
       
   </div>

    @error('pet_upload')
      <small>{{ $message }}</small>
    @enderror
      <button type="submit" class="btn btn-info btn-primary " >Import Excel File</button>
  <br/>

  <div class="modal" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="myemailLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" style="width:75%;">
        <div class="modal-content">
          <div class="modal-header text-center">
            <p class="modal-title w-100 font-weight-bold">Contact Us</p>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form  method="POST" action="{{url('contact')}}">
          {{csrf_field()}}
          <div class="modal-body mx-3" id="mailModal">
            <div class="md-form mb-5">
              <i class="fas fa-user prefix grey-text"></i>
              <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
  width: 150px; ">Send Email</label>
              <input type="text" id="sender" class="form-control validate" name="sender" placeholder="your name">
              <input type="text" id="title" class="form-control validate" name="title" placeholder="title">
              <textarea class="form-control validate" name="body" placeholder="Your message"></textarea>
            </div>
  <div class="modal-footer d-flex justify-content-center">
              <button type="submit" class="btn btn-success">Send </button>
              <button class="btn btn-light" data-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>      
    </div>
    </div>
    <div >

<!--dito lalagay yung binura -->
          </form> 
   </div>
      {{$html->table(['class' => 'table table-bordered table-striped table-hover '], true)}}
    </div>

    </div>
    <div class="modal " id="petModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document" style="width:75%;">
        <div class="modal-content">
  <div class="modal-header text-center">
            <p class="modal-title w-100 font-weight-bold">Add New Pet</p>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

  <form method="post" action="{{route('pet.store')}}" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
       <div class="modal-body mx-3" id="inputfacultyModal">
            <div class="md-form mb-5">
              <i class="fa fa-scissors grey-text"></i>
              <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
            width: 150px; ">Name</label>
              <input type="text" id="name" class="form-control validate" name="name">
            </div>

        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
              <label for="type">Type</label>
              <select name="type" id="type" class="form-select">
                <?php $types = ['','Cat','Dog', 'Bird']; ?>
                @foreach($types as $type)
                  <option value={{$type}} {{(old('status') == $type?'selected':'')}} >{{$type}}</option>
                @endforeach
                @if($errors->has('type'))
                  <small>{{ $errors->first('type') }}</small>
                @endif 
              </select>
            </div>

             <div class="md-form mb-5">
              <i class="fa fa-image prefix grey-text"></i>
              <label for="image" class="control-label">Pet Image</label>
              <input type="file" class="form-control" id="image" name="image">
              @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

  <div class="modal-footer d-flex justify-content-center">
              <button type="submit" class="btn btn-success">Save</button>
              <button class="btn btn-light" data-dismiss="modal"> <i class="fas fa-paper-plane-o ml-1">Cancel</i></button>
            </div>
          </form>
   </div>
      </div>
      
    </div>
  @push('scripts')
    {{$html->scripts()}}
  @endpush
@endsection