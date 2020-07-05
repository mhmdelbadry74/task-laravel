<?php
function responsejson($statue,$msg,$data=null){
    $response=[
    'status'=> $statue ,
    'msg'=>$msg,
    'data'=>$data,
    ];
    return response()->json($response);
}
