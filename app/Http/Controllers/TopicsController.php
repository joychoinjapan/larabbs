<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use Illuminate\Support\Facades\Auth;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request)
	{
		$topics = Topic::with('user','category')
            ->withOrder($request->order)
            ->paginate(30);
		return view('topics.index', compact('topics'));
	}

    public function show(Request $request,Topic $topic)
    {
        //强制跳转
        if(!empty($topic->slug)&&$topic->slug!= $request->slug){
            return redirect($topic->link(),301);
        }
        return view('topics.show', compact('topic'));
    }

	public function create(Topic $topic)
	{
	    $categories = Category::all();
		return view('topics.create_and_edit', compact('topic','categories'));
	}

	public function store(TopicRequest $request,Topic $topic)
	{
        $topic->fill($request->all());
        $topic->user_id=Auth::id();
		$topic->save();
		return redirect()->to($topic->link())->with('message', 'Created successfully.');
	}

	public function edit(Topic $topic)
	{
        $this->authorize('update', $topic);
        $categories = Category::all();
		return view('topics.create_and_edit', compact('topic','categories'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());
		return redirect()->to($topic->link())->with('message', 'Updated successfully.');
	}

	public function uploadImage(Request $request,ImageUploadHandler $uploadHandler)
    {
        //初始化返回数据，默认是失败的
        $data =[
            'success' => false,
            'msg' => 'upload failed',
            'file_path' => ''
        ];

        //判断是否有上传文件，并赋值给 $file
        if($file= $request->upload_file){
            $result = $uploadHandler->save($file,'topics',Auth::id(),1024);
            if($result){
                $data['file_path'] = $result['path'];
                $data['msg'] = 'upload success';
                $data['success'] = true;
            }
        }

        return $data;

    }

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();


		return redirect()->route('topics.index')->with('message', 'Deleted successfully.');
	}
}
