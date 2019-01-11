<?php 
namespace App\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\About;

use DB;
use Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Session;
use Excel;
use Bsdate;
use File; 
use Auth;

class AboutService{

    /*=====================================================================================
    // |              all About  data                                         |  ======================================================================================*/
     public function exam_attendance($batchid,$examid){
        $attendance= DB::table('attendances')->where('school_id','=',Auth::user()->school_id)->where('batch_id','=',$batchid)->where('exam_id','=',$examid)->get();
        return $attendance;
    }
     /*=====================================================================================
    |              Store Attendance data                                         |  ======================================================================================*/
    // public function save(array $data){
    //     $post=$data;
    //   $today=Carbon::now();
    //   $count=count($post['student_id']);
    //   $school_id=Auth::user()->school_id;
    //   $batch_id=$post['batch_id'];
    //   $exam_id=$post['exam_id'];
     
    //   if($count>0){
    //     for($i=0;$i<$count;$i++){
    //        $previous_attendance = DB::table('attendances')->where('school_id','=',$school_id)->where('batch_id','=',$batch_id)->where('exam_id','=',$exam_id)->where('student_id','=',$post['student_id'][$i])->get();
    //           $data=array(
    //             'school_id' =>$school_id ,
    //             'batch_id' =>$batch_id ,
    //             'exam_id' =>$exam_id ,
    //             'student_id' =>$post['student_id'][$i],
    //             'absent_days' =>$post['absent_days'][$i]
    //          );
    //          if($previous_attendance->isEmpty()){
    //             DB::table('attendances')->insert($data);   
    //          }else{
    //             DB::table('attendances')->where('id',$previous_attendance->first()->id)->update($data);
    //          } 
            
    //     }
    //   }
    //   return true;
    // }
    

}