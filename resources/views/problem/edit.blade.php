@extends('layouts.parents') 
@section('main') 
    <div class="container"> 
        <h1>Sửa Thông Tin</h1> 
        <form action="{{ route('issues.update', $issue->id)}}" method="POST"> 
            @csrf 
            @method('PUT') 
            
            <!-- Tên máy tính -->
            <div class="form-group"> 
                <label for="computer_name">Tên máy tính:</label> 
                <input type="text" class="form-control" id="computer_name" name="computer_name" value="{{ $issue->computer->computer_name }}" required> 
                @error('computer_name') <!-- Hiển thị lỗi cho trường này nếu có -->
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div> 
            
            <!-- Tên phiên bản -->
            <div class="form-group"> 
                <label for="model">Tên phiên bản:</label> 
                <input type="text" class="form-control" id="model" name="model" value="{{ $issue->computer->model }}" required> 
                @error('model')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div> 

            <!-- Người báo cáo sự cố -->
            <div class="form-group"> 
                <label for="reported_by">Người báo cáo sự cố:</label> 
                <input type="text" class="form-control" id="reported_by" name="reported_by" value="{{ $issue->reported_by }}" required>
                @error('reported_by')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div> 

            <!-- Thời gian báo cáo -->
            <div class="form-group"> 
                <label for="reported_date">Thời gian báo cáo:</label> 
                <input type="date" class="form-control" id="reported_date" name="reported_date" value="{{ $issue->reported_date }}" required> 
                @error('reported_date')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div> 

            <!-- Mức độ sự cố -->
            <div class="form-group"> 
                <label for="urgency">Mức độ sự cố:</label> 
                <input type="text" class="form-control" id="urgency" name="urgency" value="{{ $issue->urgency }}" required> 
                @error('urgency')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div> 

            <!-- Trạng thái hiện tại -->
            <div class="form-group"> 
                <label for="status">Trạng thái hiện tại:</label> 
                <input type="text" class="form-control" id="status" name="status" value="{{ $issue->status }}" required> 
                @error('status')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div> 
            
            <button type="submit" class="btn btn-primary">Lưu</button> 
        </form> 
    </div> 
@endsection
