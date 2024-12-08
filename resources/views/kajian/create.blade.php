@extends('layouts.main')

@section('container')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tambah Kajian</h5>
                <form action="/kajian/create" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title')}}" required>
                    </div>

                    <div class="mb-3">
                        <label for="speaker_name" class="form-label">Speaker Name</label>
                        <input type="text" class="form-control" id="speaker_name" name="speaker_name" value="{{ old('speaker_name')}}" required>
                    </div>

                    <div class="mb-3">
                        <label for="theme" class="form-label">Theme</label>
                        <input type="text" class="form-control" id="theme" name="theme" value="{{ old('theme')}}" required>
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
                    </div>
                    

                    <div class="mb-3">
                        <label for="price" class="form-label">price</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ old('price')}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location" value="{{ old('location')}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Start Time</label>
                        <input type="time" class="form-control" id="start_time" name="start_time" value="{{ old('start_time') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="end_time" class="form-label">End Time</label>
                        <input type="time" class="form-control" id="end_time" name="end_time" value="{{ old('end_time') }}" required>
                    </div>
                    
                   

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
