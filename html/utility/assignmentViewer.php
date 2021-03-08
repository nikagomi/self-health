<?php
session_start();

require_once (__DIR__.'/../../vendor/autoload.php');

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
$oa = (new \Ole\Model\OleOnlineAssignment())->getObjectById($id);
$div = '';

if (!$oa->isIdEmpty()) {

    $div .= '<div class="row">';
    $div .= '<div class="medium-3 end columns text-right">';
    $div .= '<label class="viewLabel"><span>File:&nbsp;</span></label>';
    $div .= '</div>';
    $div .= '<div class="medium-9 end columns text-left">';
    $div .= '<label style="font-size:0.95rem;"><a href="/utility/assignmentDownloader.php?assessmentId='.$oa->getSubjectGradeActivityId().'">'.$oa->getFileName().'</a></label>';
    $div .= '</div>';
    $div .= '</div>';


    $div .= '<div class="row">';
    $div .= '<div class="medium-3 end columns text-right">';
    $div .= '<label class="viewLabel">&nbsp;</span></label>';
    $div .= '</div>';
    $div .= '<div class="medium-9 end columns text-left">';
    $div .= '<label class=""><a href="/utility/assignmentDownloader.php?assessmentId='.$oa->getSubjectGradeActivityId().'"><i class="fas fa-cloud-download-alt" style="font-size:1.4rem;color:#305070;"></i>&ensp;&ensp;&ensp;&ensp;&ensp;';
  // $div .= '<div>';
    if (!$oa->hasSubmissions()) {
        $div .= '<a class="deleteAssgn" href="#" onclick="return false;" data-id="'.$oa->getId().'"><i class="fas fa-trash-alt" style="font-size:1.4rem;color:#FF0000;"></i>';
    } else {
        $div .= '<span class="" style="color:#008cba;font-size:1rem;">'.\count($oa->getSubmissions()).' submissions</span>';
    }    
    $div .= '&ensp;&ensp;<a href="/online/assignment/submissions/view/'.$oa->getId().'" style="font-size:0.8rem;">view</a>';
  //  $div .= '</div>';
    $div .= '</label>';
    $div .= '</div>';
    $div .= '</div>';
} else {
    $div .= '<div class="errorMessage">Sorry, could not identify the selected assignment upload.</div>';
}

echo $div;
