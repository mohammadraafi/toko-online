@extends('layouts.dashboard')

@section('title', 'Dashboard Products Create')
    
@section('content')
   <!-- Page Content -->
   <div id="page-content-wrapper">
    <div
      class="section-content section-dashboard-home"
      data-aos="fade-up"
    >
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-title">Add New Product</h2>
          <p class="dashboard-subtitle">
            Create your own product
          </p>
        </div>
        <div class="dashboard-content">
          <div class="row">
            <div class="col-12">
              @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all as $error)
                            <li> {{ $error}} </li>
                        @endforeach
                    </ul>
                </div>
              @endif
              <form action="{{route('dashboard-product-store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="users_id" value="{{Auth::user()->id}}">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="name">Product Name</label>
                          <input
                            type="text"
                            class="form-control"
                            id="name"
                            aria-describedby="name"
                            name="name"
                          />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="price">Price</label>
                          <input
                            type="number"
                            class="form-control"
                            id="price"
                            aria-describedby="price"
                            name="price"
                          />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="quantity">Quantity</label>
                          <input
                            type="number"
                            class="form-control"
                            id="quantity"
                            aria-describedby="price"
                            name="quantity"
                          />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Kategori</label>
                          <select name="categories_id" class="form-control">
                           @foreach ($categories as $category)
                           <option value="{{$category->id}}">
                            {{$category->name}}
                          </option>
                           @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="description">Description</label>
                          <textarea
                            name="description"
                            id="editor"
                            cols="30"
                            rows="4"
                            class="form-control">
                          </textarea>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="photos">Thumbnails</label>
                          <input
                            type="file"
                            multiple
                            class="form-control pt-1"
                            id="photos"
                            aria-describedby="photos"
                            name="photos"
                          />
                          <small class="text-muted">
                            Kamu dapat memilih lebih dari satu file
                          </small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col pb-4">
                    <button
                      type="submit"
                      class="btn btn-success btn-block px-5"
                    >
                      Save Now
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('addon-script')
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
</script>

<script>
    function thisFileUpload() {
      document.getElementById("file").click();
    }
  </script>
@endpush

