<?php

namespace Modules\Edu\Api\Front;

use Modules\Edu\Http\Requests\LessonRequest;
use Modules\Edu\Transformers\LessonResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Modules\Edu\Entities\Lesson;
use Modules\Edu\Entities\Video;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Site;
use Auth;

/**
 * 课程管理
 * @package Modules\Edu\Http\Controllers\Admin
 */
class LessonController extends Controller
{
    public function __construct()
    {
    }

    /**
     * 课程列表
     * @return void
     */
    public function index()
    {
        $lessons = Lesson::where('site_id', SID)->latest()->paginate(12);
        return LessonResource::collection($lessons);
    }

    /**
     * 获取课程
     * @param Lesson $lesson
     * @return void
     */
    public function show(Lesson $lesson)
    {
        return new LessonResource($lesson->load('videos'));
    }

    /**
     * 保存课程
     *
     * @param LessonRequest $request
     * @param Lesson $lesson
     * @return void
     */
    public function store(LessonRequest $request, Lesson $lesson)
    {
        DB::beginTransaction();
        $lesson->fill($request->except(['file', 'tags', 'videos']) + [
            'user_id' => Auth::id(),
            'site_id' => site()->id
        ])->save();

        $lesson->tags()->sync($request->tags);
        $this->updateVideos($lesson, $request);
        DB::commit();
        return ['message' => '课程添加成功'];
    }

    /**
     * 更新课程
     * @param LessonRequest $request
     * @param Lesson $lesson
     * @return void
     */
    public function update(LessonRequest $request, Lesson $lesson)
    {
        DB::beginTransaction();
        $lesson->fill($request->except(['file', 'tags', 'videos']))->save();
        $lesson->tags()->sync($request->tags);
        $this->updateVideos($lesson, $request);
        DB::commit();
        return ['message' => '课程修改成功'];
    }

    /**
     * 更新视频
     *
     * @param Lesson $lesson
     * @param Request $request
     * @return void
     */
    protected function updateVideos(Lesson $lesson, Request $request)
    {
        $lesson->videos()->whereNotIn('id', collect($request->videos)->pluck('id'))->delete();
        foreach ($request->videos as $rank => $video) {
            if ($video['title']) {
                Video::updateOrCreate(['id' => $video['id'] ?? 0], [
                    'site_id' => site()['id'],
                    'lesson_id' => $lesson['id'],
                    'rank' => $rank
                ] + $video);
            }
        }
    }

    /**
     * 删除视频
     *
     * @param Lesson $lesson
     * @return void
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return back()->with('success', '视频删除成功');
    }

    /**
     * 搜索课程
     * @param Request $request
     * @return void
     */
    public function search(Request $request)
    {
        $lessons = Lesson::when($request->keyword, function ($query, $keyword) {
            return $query->where('title', 'like', "%{$keyword}%");
        })->limit(10)->get();
        return $lessons;
    }
}