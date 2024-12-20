@extends('layouts.parents')

@section('title','Truong dai hoc thuy loi');
    
@section('main')
<h3 class="text-center" style="margin-top:40px">Danh sách vấn đề</h3>
<table class="table">
    <thead>
      <tr>
        <th scope="col">Mã vấn đề</th>
        <th scope="col">Tên máy tính</th>
        <th scope="col">Tên phiên bản</th>
        <th scope="col">Người BCSC</th>
        <th scope="col">Thời gian báo cáo</th>
        <th scope="col">Mức độ sự cố</th>
        <th scope="col">Trạng thái</th>
        <th scope="col" colspan=3 class="text-center">Hành Động</th>
      </tr>
    </thead>
    <tbody>
      @foreach($issues as $issue)
      <tr>
        <th scope="row">{{$issue->id}}</th>
        <td>{{$issue->computer->computer_name}}</td>
        <td>{{$issue->computer->model}}</td>
        <td>{{$issue->reported_by}}</td>
        <td>{{$issue->reported_date}}</td>
        <td>{{$issue->urgency}}</td>
        <td>{{$issue->status}}</td>
        <td>
          <a href="{{route('issues.edit',$issue->id)}}"><i class="bi bi-pencil-square"></i></a>
        </td>
        <td>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{$issue->id}}">
            <i class="bi bi-trash3-fill"></i>
          </button>

          <div class="modal fade" id="{{$issue->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="{{$issue->id}}">Xóa Bài Viết</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Bạn có chắc chắn muốn xóa không ? 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <form action="{{route('issues.destroy',$issue->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary">Xoa</button>
                </form>
                </div>
              </div>
            </div>
          </div>

      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="d-flex justify-content-center">
    {{ $issues->links('pagination::bootstrap-4') }}
  </div>
@endsection