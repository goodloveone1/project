<?php

    function timespan($seconds = 1, $time = '')
    {
        if ( ! is_numeric($seconds))
        {
            $seconds = 1;
        }
    
        if ( ! is_numeric($time))
        {
            $time = time();
        }
    
        if ($time <= $seconds)
        {
            $seconds = 1;
        }
        else
        {
            $seconds = $time - $seconds;
        }
    
        $str = '';
        $years = floor($seconds / 31536000);
    
        if ($years > 0)
        {	
            $str .= $years.' ปี ';
        }	
    
        $seconds -= $years * 31536000;
        $months = floor($seconds / 2628000);
    
        if ($years > 0 OR $months > 0)
        {
            if ($months > 0)
            {	
                $str .= $months.' เดือน ';
            }	
    
            $seconds -= $months * 2628000;
        }
    
        // $weeks = floor($seconds / 604800);
    
        // if ($years > 0 OR $months > 0 OR $weeks > 0)
        // {
        // 	if ($weeks > 0)
        // 	{	
        // 		$str .= $weeks.' สัปดาห์, ';
        // 	}
    
        // 	$seconds -= $weeks * 604800;
        // }			
    
        $days = floor($seconds / 86400);
    
        if ($months > 0 OR $weeks > 0 OR $days > 0)
        {
            if ($days > 0)
            {	
                $str .= $days.' วัน';
            }
    
            $seconds -= $days * 86400;
        }
    
        // $hours = floor($seconds / 3600);
    
        // if ($days > 0 OR $hours > 0)
        // {
        // 	if ($hours > 0)
        // 	{
        // 		$str .= $hours.' ชั่วโมง, ';
        // 	}
    
        // 	$seconds -= $hours * 3600;
        // }
    
        // $minutes = floor($seconds / 60);
    
        // if ($days > 0 OR $hours > 0 OR $minutes > 0)
        // {
        // 	if ($minutes > 0)
        // 	{	
        // 		$str .= $minutes.' นาที, ';
        // 	}
    
        // 	$seconds -= $minutes * 60;
        // }
    
        // if ($str == '')
        // {
        // 	$str .= $seconds.' วินาที';
        // }
    
        return substr(trim($str), 0, 100);
    }

    function DateThai($strDate){
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strMonthCut = Array("","มกราคม.","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
    }


    function DateThaiTime($strDate){
        $strYear = date("Y",strtotime($strDate))+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("j",strtotime($strDate));
        $strHour= date("H",strtotime($strDate));
        $strMinute= date("i",strtotime($strDate));
        $strSeconds= date("s",strtotime($strDate));
        $strMonthCut = Array("","มกราคม.","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        $strMonthThai=$strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
        }


?>