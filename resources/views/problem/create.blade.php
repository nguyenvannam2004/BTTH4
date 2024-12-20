@extends('layouts.parents')
@section('main') 
    <div class="container"> 
        <h1>Thêm mới vấn đề</h1> 
        <form action="{{ route('issues.store') }}" method="POST"> 
            @csrf 
            <div class="form-group"> 
                <label for="title">Tên máy tính:</label> 
                <input type="text" class="form-control" id="computer_name" name="computer_name" value="" required> 
            </div> 
            <div class="form-group"> 
                <label for="description">Tên phiên bản:</label> 
                <textarea class="form-control" id="model" name="model" required></textarea> 
            </div> 
            <div class="form-group"> 
                <label for="long_description">Người báo cáo sự cố:</label> 
                <textarea class="form-control" id="reported_by" name="reported_by"></textarea> 
            </div> 
            
            <div class="form-group"> 
                <label for="long_description">Thời gian báo cáo:</label> 
                <textarea class="form-control" id="reported_date" name="reported_date"></textarea> 
            </div> 

            <div class="form-group"> 
                <label for="long_description">Mức độ sự cố:</label> 
                <textarea class="form-control" id="urgency" name="urgency"></textarea> 
            </div> 

            <div class="form-group"> 
                <label for="long_description">Trạng thái hiện tại:</label> 
                <textarea class="form-control" id="status" name="status"></textarea> 
            </div> 
            <button type="submit" class="btn btn-primary">Lưu</button> 
        </form> 
    </div> 
@endsection 