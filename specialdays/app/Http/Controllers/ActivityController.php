<?php

namespace App\Http\Controllers;

use App\Activity;
use App\ActivityImage;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $mActivity = new Activity;

        $mActivity = $mActivity::with('place','type','image');

        if($request['activity_state_id']){
            $mActivity = $mActivity->where('activity_state_id',$request['activity_state_id']);
        }

        if($request['name']){
            $mActivity = $mActivity->where('name',$request['name']);
        }

        if($request['subway_id']){
            $subway_id = $request['subway_id'];
            $mActivity = $mActivity->whereIn('place_id',function($query) use ($subway_id){
                $query->select('place_id')
                    ->from('place_subway')
                    ->where('subway_id',$subway_id);
            });
        }



        //return ['activities'=>$mActivity->orderBy('id', 'desc')->paginate(20)];
        /*return response()
            ->json(['activities'=>$mActivity->orderBy('id', 'desc')->paginate(20)])
            ->setCallback($request->input('callback'));*/
        return response()
            ->json(['activities'=>$mActivity->orderBy('id', 'desc')->paginate(100)])
            ->setCallback($request->input('callback'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
/*    public function create()
    {
        //
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
/*    public function update(Request $request, Activity $activity)
    {
        //
    }*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
    }



    //2018.02.10 lagacy
    public function activities(Request $request)
    {
        $mActivity = new Activity;


        if($request['activity_state_id']){
            $mActivity = $mActivity->where('activity_state_id',$request['activity_state_id']);
        }

        if($request['name']){
            $mActivity = $mActivity->where('name',$request['name']);
        }



        return view('admin/activity/list',['activities'=>$mActivity->orderBy('id', 'desc')->paginate(20)]);
    }


    private function deleteImages($request){

        $rDeletingImageId = $request->deletingImages;

        if($rDeletingImageId ){
            $activityId = $request->id;

            $mActivityImage = new ActivityImage;

            foreach($rDeletingImageId as $imageId){
                $activityImage = $mActivityImage->where('activity_id','=',$activityId)
                    ->where('image_id','=',$imageId)
                    ->first();
                $activityImage->delete();
            }

            $imageController = new ImageController();
            $imageController->delete($rDeletingImageId);


        }

    }

    private function activityValidate(Request $request){
        $this->validate($request, [
            'name' => 'required|max:50',
            'introduce' => 'max:2000',
            'description' => 'max:100',
            'must_read' => 'max:100'
        ]);
    }


    /**
     * Create a new activity instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public function insertActivity(Request $request)
    {

        $mActivity = new Activity;
        if($request->place_id) $mActivity->place_id = $request->place_id;
        $mActivity->name = $request->name;
        $mActivity->activity_state_id = 1;
        $mActivity->activity_type_id = $request->activity_type_id;
        $mActivity->main_price = $request->main_price;
        $mActivity->introduce = $request->introduce;
        $mActivity->description = $request->description;
        $mActivity->must_read = $request->must_read;
        $mActivity->created_by = 'admin';
        $mActivity->updated_by = 'admin';

        $mActivity->save();

        $imageController = new ImageController();
        $arrImage = $imageController->create($request, 'imgs', 'activities', 'admin');

        if(is_array($arrImage)){
            $mActivityImage = new ActivityImage;
            foreach($arrImage as $i => $image_id){
                $mActivityImage->activity_id = $mActivity->getKey();
                $mActivityImage->image_id = $image_id;
                $mActivityImage->sort = $i;
                $mActivityImage->save();
            }
        }

        return redirect()->route('admin.place',['id' => $request->place_id]);
    }

    /**
     * Update a new activity instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updateActivity(Request $request)
    {
        $this->activityValidate($request);

        $activityId = $request->id;

        $mActivity = new Activity;
        $activity = $mActivity->find($activityId) ;
        $activity->name = $request->name;
        $activity->activity_type_id = $request->activity_type_id;
        $activity->main_price = $request->main_price;
        $activity->introduce = $request->introduce;
        $activity->description = $request->description;
        $activity->must_read = $request->must_read;
        $activity->updated_by = 'admin';

        $activity->save();

        //processing image
        $this->deleteImages($request);
        $imageController = new ImageController();
        $arrImage = $imageController->create($request, 'imgs', 'activities', 'admin');


        if(is_array($arrImage)){
            $mActivityImage = new ActivityImage;

            $maxSortImage = $mActivityImage->where('activity_id','=',$activityId)
                ->orderby('sort','desc')
                ->first();
            $maxSort = $maxSortImage ? $maxSortImage->sort+1 : 0 ;

            foreach($arrImage as $i => $image_id){
                $mActivityImage->activity_id = $activityId;
                $mActivityImage->image_id = $image_id;
                $mActivityImage->sort = $maxSort +$i;
                $mActivityImage->save();
            }
        }

        return redirect()->route('admin.place',['id' => $request->place_id]);
    }
}
