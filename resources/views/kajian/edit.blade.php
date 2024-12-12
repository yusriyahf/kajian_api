@extends('layouts.main')

@section('container')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">Edit Data Kajian</h5>
                <form action="/kajian/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $data->title) }}" required>
                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                
                    <div class="mb-3">
                        <label for="speaker_name" class="form-label">Speaker Name</label>
                        <input type="text" class="form-control @error('speaker_name') is-invalid @enderror" id="speaker_name" name="speaker_name" value="{{ old('speaker_name', $data->speaker_name) }}" required>
                        @error('speaker_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                
                    <div class="mb-3">
                        <label for="theme" class="form-label">Theme</label>
                        <input type="text" class="form-control @error('theme') is-invalid @enderror" id="theme" name="theme" value="{{ old('theme', $data->theme) }}" required>
                        @error('theme')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $data->date) }}" required>
                        @error('date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $data->price) }}" required>
                        @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', $data->location) }}" required>
                        @error('location')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Start Time</label>
                        <input type="time" class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" value="{{ old('start_time', $data->start_time) }}" required>
                        @error('start_time')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                
                    <div class="mb-3">
                        <label for="end_time" class="form-label">End Time</label>
                        <input type="time" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" value="{{ old('end_time', $data->end_time) }}" required>
                        @error('end_time')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- @if ($data->image) <!-- Ganti dengan kondisi yang sesuai jika image berisi path gambar -->
                        <div class="mb-3">
                            <label for="image_preview" class="form-label">Preview Gambar</label>
                            <div>
                                <img src="{{ asset('storage/' . $data->image) }}" alt="Preview Gambar" class="img-fluid" width="100%">
                            </div>
                        </div>
                    @endif --}}
                

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6 d-flex align-items-stretch">
        
        <div class="card w-100">
          <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Total Pemasukan</h5>
                <p>{{ $totalPrice }}</p>
            <h5 class="card-title fw-semibold mb-4">Total Kehadiran</h5>
            <div class="table-responsive">
              <table class="table table-bordered text-nowrap mb-4 align-middle">
                <thead class="text-dark fs-4">
                  <tr>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">No</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Gender</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Total</h6>
                    </th>
                   
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">1</h6></td>
                    <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-1">All</h6>
                    </td>
                    <td class="border-bottom-0">
                      <p class="mb-0 fw-normal">{{ $totalAll }}</p>
                    </td>
                
                  </tr> 
                  <tr>
                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">2</h6></td>
                    <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-1">Male</h6>
                    </td>
                    <td class="border-bottom-0">
                      <p class="mb-0 fw-normal">{{ $totalMale }}</p>
                    </td>
                
                  </tr> 
                  <tr>
                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">3</h6></td>
                    <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-1">Female</h6>
                    </td>
                    <td class="border-bottom-0">
                      <p class="mb-0 fw-normal">{{ $totalFemale }}</p>
                    </td>
                
                  </tr> 
                                     
                </tbody>
              </table>
            <h5 class="card-title fw-semibold mb-4">Kehadiran</h5>
            <div class="table-responsive">
              <table class="table table-bordered text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                  <tr>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">No</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Name</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Gender</h6>
                    </th>
                   
                  </tr>
                </thead>
                <tbody>
                    @foreach ($kehadiran as $k)
                  <tr>
                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6></td>
                    <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-1">{{ $k->user->first_name }} {{ $k->user->last_name }}</h6>
                    </td>
                    <td class="border-bottom-0">
                        <p class="mb-0 fw-normal">
                            @if ($k->male)
                                Male
                            @elseif ($k->female)
                                Female
                            @else
                                Unknown
                            @endif
                        </p>
                    </td>
                
                  </tr> 
                  @endforeach
                                     
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection
