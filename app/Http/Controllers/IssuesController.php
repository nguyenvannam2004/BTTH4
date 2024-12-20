<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\issues;
use App\Models\computers;
class IssuesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $issues = issues::with('computer')->paginate(10);
        return  view('problem.index',compact('issues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('problem.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'computer_name' => 'required|string|max:255',
            'model' => 'required|string|max:255', 
            'operating_system' => 'nullable|string|max:255',  // Cho phép operating_system là null
            'processor' => 'nullable|string|max:255',  // Cho phép processor là null
            'memory' => 'nullable|string|max:255',  // Cho phép memory là null
            'available' => 'nullable|boolean',  // Cho phép available là null
            'reported_by' => 'required|string|max:255',
            'reported_date' => 'required|date',
            'urgency' => 'required|string',
            'status' => 'required|string',
            'description' => 'nullable|string|max:255',
        ]);

        // Tìm hoặc tạo máy tính mới, cho phép lưu các trường nullable
        $computer = computers::firstOrCreate(
            ['computer_name' => $request->computer_name, 'model' => $request->model],
            [
                'operating_system' => $request->operating_system, // Nếu không có giá trị, sẽ là null
                'processor' => $request->processor,  // Nếu không có giá trị, sẽ là null
                'memory' => $request->memory,  // Nếu không có giá trị, sẽ là null
                'available' => $request->available,
                  // Nếu không có giá trị, sẽ là null
            ]
        );

        // Tạo mới vấn đề liên kết với máy tính
        $issue = new issues();
        $issue->computer_id = $computer->id; 
        $issue->reported_by = $request->reported_by;
        $issue->reported_date = $request->reported_date;
        $issue->urgency = $request->urgency;
        $issue->status = $request->status;
        $issue->description = $request->description ?? '';
        $issue->save(); 

        return redirect()->route('issues.index')->with('success', 'Vấn đề đã được thêm thành công');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $issue = issues::with('computer')->find($id);
        return view('problem.edit',compact('issue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'computer_name' => 'required|string|max:255',
            'model' => 'required|string|max:255', 
            'operating_system' => 'nullable|string|max:255',  
            'processor' => 'nullable|string|max:255',  
            'memory' => 'nullable|string|max:255',  
            'available' => 'nullable|boolean',  
            'reported_by' => 'required|string|max:255',
            'reported_date' => 'required|date',
            'urgency' => 'required|in:High,Medium,Low',
            'status' => 'required|in:Open,In Progress,Resolved',
        ]);
    
        // 2. Tìm vấn đề (issue) cần cập nhật
        $issue = issues::findOrFail($id);  // Sử dụng findOrFail để lấy ra vấn đề hoặc trả về lỗi nếu không tìm thấy
    
        // 3. Cập nhật thông tin máy tính (computer)
        $computer = $issue->computer;  // Lấy máy tính liên quan đến vấn đề này
    
        // Cập nhật máy tính (nếu cần)
        $computer->computer_name = $request->computer_name;
        $computer->model = $request->model;
        $computer->operating_system = $request->operating_system ?? $computer->operating_system;  // Giữ giá trị cũ nếu không có thay đổi
        $computer->processor = $request->processor ?? $computer->processor;
        $computer->memory = $request->memory ?? $computer->memory;
        $computer->available = $request->available ?? $computer->available;
        $computer->save();  // Lưu máy tính đã cập nhật
    
        // 4. Cập nhật các thông tin khác của vấn đề (issue)
        $issue->reported_by = $request->reported_by;
        $issue->reported_date = $request->reported_date;
        $issue->urgency = $request->urgency;
        $issue->status = $request->status;
        $issue->save();  // Lưu vấn đề đã cập nhật
    
        // 5. Chuyển hướng người dùng về trang danh sách với thông báo thành công
        return redirect()->route('issues.index')->with('success', 'Vấn đề đã được cập nhật thành công');
    }

    
    public function destroy(string $id)
    {
        $issue = issues::findOrFail($id); 
        $issue->delete();  
        return redirect()->route('issues.index')->with('success', 'Vấn đề đã được xóa thành công');
    }
}
