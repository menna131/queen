<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LimitIterator;
use SplFileObject;

class LogController extends Controller
{    
    /**
     * readLogFile
     *
     * @param  Request $request
     * @return Array $return_array and the value of the start line
     */
    public function readLogFile(Request $request)
    {
        /**
         * request has 1 input
         * $file_name => the path of the file we want to navigate
         * - here the file is going to be "C:\xampp_8\htdocs\queen\storage/logs/Apache.log"
         */
        if(isset($request->all()['view'])){
            $request->session()->forget('file_name');
            $request->session()->forget('last_line');
            $request->session()->forget('start');
                if($request->all()['file_name'] != null){
                    $file_name = $request->all()['file_name'];
                    // get the number of the last line of the file
                    $file_r = new SplFileObject($request->all()['file_name']);
                    $file_r->seek(PHP_INT_MAX);
                    $last_line = $file_r->key() + 1; //12012725
        
                    // put file name and last line number in session
                    $request->session()->put('file_name', $file_name);
                    $request->session()->put('last_line', $last_line);
                    $request->session()->put('start', 0);
                }else{
                    return ['error' => 'enter file name'];
                }
        }
        if($request->session()->get('file_name')){
            // if next button is clicked
            if($request->has('next')){
                if($request->session()->get('start') == ($request->session()->get('last_line') - 10)){
                    return $return_array = [];
                }
                // get the new start by adding 10 lines and then add 1
                $new_start = $request->session()->get('start')+10;
                $request->session()->put('start', $new_start);
            }
            // if previous button is clicked
            if($request->has('previous')){
                if($request->session()->get('start')-10 < 0){
                    return $return_array = [];
                }
                // get the new start by subtracting 10 lines and then subtracting 1
                $new_start = $request->session()->get('start')-10;
                $request->session()->put('start', $new_start);
            }
            // if first button is clicked
            if($request->has('first')){
                if($request->session()->get('start') <= 0){
                    return $return_array = [];
                }
                // get the new start which is 0
                $request->session()->put('start', 0);
            }
            // if last button is clicked
            if($request->has('last')){
                if($request->session()->get('start') == ($request->session()->get('last_line') - 10)){
                    return $return_array = [];
                }
                // get the new start by subtracting 11 lines from last line
                $request->session()->put('start', $request->session()->get('last_line')-10);
            }
        }
        
        // get the 10 lines
        $file = new LimitIterator(
            new SplFileObject($request->session()->get('file_name')), $request->session()->get('start'), 10);

        // returning the array of the wanted lines
        $return_array=[];
        foreach($file as $key => $line){
            $return_array[$key] = $line;
        }
        return [$return_array, $request->session()->get('start')];
    }
    
    /**
     * viewLog
     *
     * @return view log
     */
    public function viewLog()
    {
        return view('log');
    }
}
