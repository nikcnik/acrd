<?php 
include "func/class/db.php";
include "func/class/user.php";
include "func/class/content.php";
include "func/class/aveSummaryRating.php";

$newUser = new User();
$cons = new constant();

session_start();

if (isset($_SESSION['type'])) {
  if ($_SESSION['type']=='1') {
    header("Location: staff.php");
  }elseif($_SESSION['type']=='3'){
    header("Location: dean.php");
  }elseif($_SESSION['type']=='4'){
    header("Location: admin.php");
  }
}else{
  header("Location: ./");
}

$uStat = $_SESSION['userStat'];
$uId   = $_SESSION['userId'];

include 'header.php'; 

?>
<style>
  

  .m-func-icon:hover {
    color: green;
    cursor: pointer;  
  }
  #m-upload-list{
    list-style: none;
  }
  #m-upload-list li{
    margin-bottom: 3px;
  }
  .m-view-upload:hover{
    cursor: pointer;
    color: #cfcfcf;
  }
  .m-upload-close{
    color:blue; background: #fff; border:none;
  }
  .m-upload-close:hover{
    color: #333;
    background: #fff;
  }
  .m-eval-rate-icon:hover{
    cursor: pointer;
  }
</style>

<!--CONTENT START-->
<div class="row" style="margin:0; background: #fff;">
  <input id="user-status" type="hidden" <?php echo "value=\"$uStat\""; ?>>

  <div class="col-lg-3" style="background: #eee; border-right:solid 2px #eee;">
    <?php 
      $summaryRate = new aveSummaryRating();
      $summaryRate->userAreaEval($uId);
    ?>
  </div>

  <div class="col-lg-7" style="background: #fff;">
    <?php $cons->viewEvaluatorContent($uId); ?>
    
  </div>

  <div class="col-lg-2" style="background: #fff; border-left: solid 2px #eee; position: relative; font-size: 14px;">
    <div class="col-lg-2" style="position: fixed; height: 665px; overflow: scroll; padding-left:0px;">
      
        <?php $cons->contentScroll($uId, 'evaluator') ?>    
    </div>
  </div>
</div>
  
<!--CONTENT END-->

<?php include 'footer.php'; ?>


<div class="modal fade " id="preReg-code" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <input id="succ" type="hidden" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title" >PRE REGISTRATION</p>
        <i id="mssgArea" style="  color:red"></i>
      </div>
      
      <div class="modal-body">
        <div class="row">
          <input type="hidden"  name="userId" <?php echo "value=\"$uId\"" ?>>
          <input class=" form-control form-control-sm" name="verCode" type="text" placeholder="VERIFICATION CODE..." style="text-align: center;">
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="validate" >validate</button>
        <a  class="btn btn-danger" href="func/logout.php">cancel</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade " id="preReg-other-info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <input id="succ" type="hidden" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title" >PRE REGISTRATION</p>
        <i id="pre-mssgArea" style="  color:red"></i>
      </div>
      <div class="modal-body">
        <div class="row">
            <?php $newUser->preReg($uId); ?>
        </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-success" id="savePreReg" >Save changes</button>
          <a  class="btn btn-danger" href="func/logout.php">cancel</a>
        </div>
    </div>
  </div>
</div>




<!--MODAL-->
  <!--UPLOAD MODAL-->
<div class="modal fade " id="upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  style="">
  <input id="succ" type="hidden" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border:0;">
      
      <div class="modal-header" style="background:#196F3D;" >
        <div class="row" >
          <div class="col-lg-12" style="font-family:arial narrow;  color:#fff;">
            <i class="fa fa-file-archive"></i> 
          <strong id="upload_sub_a">
            SUB-AREA
          </strong>
          
          </div>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#fff;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body" style="padding-top:0; border:none;">
        <ul class="row" style="padding-left:0; border:0;">
          
          
          <div class="col-sm-12" style="font-family:arial narrow; color:#555; background: #ddd;">
            <strong id="upload_category">
              CATEGORY NO.
            </strong>
          </div>
          <div class="col-sm-12" style="font-family:arial narrow; color:#555; background: #eee;">
            <strong id="upload_content">
              CONTENT NO.
            </strong>
          </div>
        </ul>
       
        <ul id="m-upload-list">
          <!--VIEW LIST OF UPLOADED FILE/S--> 
        </ul>

      </div>
     
      <div class="modal-footer">
          <button type="button" class="form-control btn btn-secondary m-upload-close" data-dismiss="modal" >Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade " id="view_docu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog " role="document" style="width: 100%; max-width:1000px;">
    <div class="modal-content">
      <div class="modal-header">
          <p class="modal-title" ><i class="fa fa-file-archive"></i> VIEW DOCUMENT </p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            
          </div>
        </div>
      </div>

      <div class="modal-footer">
          <button type="button" class="form-control btn btn-secondary m-upload-close" data-dismiss="modal" >Close</button>
      </div>
    </div>
  </div>
</div>



<!--NOTES MODAL-->
<div class="modal fade " id="notes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">

        
      <div class="modal-header" style="background:#196F3D;" >
        <div class="row" >
          <div class="col-lg-12" style="font-family:arial narrow;  color:#fff;">
            <i class="fa fa-sticky-note"></i> 
          <strong id="notes_sub_a">
            SUB-AREA
          </strong>
          
          </div>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#fff;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body" style="padding-top:0; border:none;">
        <ul class="row" style="padding-left:0; border:0;">
          
          
          <div class="col-sm-12" style="font-family:arial narrow; color:#555; background: #ddd;">
            <strong id="notes_category">
              CATEGORY NO.
            </strong>
          </div>
          <div class="col-sm-12" style="font-family:arial narrow; color:#555; background: #eee;">
            <strong id="notes_content">
              CONTENT NO.
            </strong>
          </div>
        </ul>
        
        <!--notes INPUTS-->
        <div id="notes_area" class="col-lg-12"></div>
        <div class="col-lg-12"><br></div>

        <form id="notes_form">
          <input id="notes_cnt_id" name="notes_cnt_id" type="hidden">
          <textarea id="notes_input" name="notes_input" id="" class="col-lg-12 form-control"></textarea>
          <button type="submit" class="col-lg-12 form-control btn btn-primary">Note</button>        
        </form>
      
      </div>

      <div class="modal-footer">
          <button type="button" class="form-control btn btn-secondary m-upload-close" data-dismiss="modal" >Close</button>
      </div>
      
    </div>
  </div>
</div>

<!--EVALRATE MODAL-->
<div class="modal fade " id="evalrate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#196F3D;" >
        <div class="row" >
          <div class="col-lg-12" style="font-family:arial narrow;  color:#fff;">
            <i class="fa fa-star-half-alt"></i> 
          <strong id="evalRate_sub_a">
            SUB-AREA
          </strong>
          
          </div>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#fff;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body" style="padding-top:0; border:none;">
        <ul class="row" style="padding-left:0; border:0;">
          
          
          <div class="col-sm-12" style="font-family:arial narrow; color:#555; background: #ddd;">
            <strong id="evalRate_category">
              CATEGORY NO.
            </strong>
          </div>
          <div class="col-sm-12" style="font-family:arial narrow; color:#555; background: #eee;">
            <strong id="evalRate_content">
              CONTENT NO.
            </strong>
          </div>
        </ul>

          <input id="cnt_key" type="hidden">

          <div class="row">
            
            <div class="col-sm-3"></div>
            <h5 class="col-sm-6" style="text-align: center; color: #3498DB;">Documentor Rate</h5>
            <div class="col-sm-3"></div>


            <div class="col-sm-3"></div>
            <div class="col-sm-6" style="text-align: center; ">
              <i class="fa fa-star m-self-rate-icon" id="selfR1" data-var="1"></i>
              <i class="fa fa-star m-self-rate-icon" id="selfR2" data-var="2"></i>
              <i class="fa fa-star m-self-rate-icon" id="selfR3" data-var="3"></i>
              <i class="fa fa-star m-self-rate-icon" id="selfR4" data-var="4"></i>
              <i class="fa fa-star m-self-rate-icon" id="selfR5" data-var="5"></i>
            </div>
            <div class="col-sm-3"></div>
            
            <div class="col-sm-3"></div>
            <h5 class="col-sm-6" style="text-align: center;">Your Rate</h5>
            <div class="col-sm-3"></div>


            <div class="col-sm-3"></div>
            <div class="col-sm-6" style="text-align: center">
              <i class="fa fa-star m-eval-rate-icon" id="evalR1" data-var="1"></i>
              <i class="fa fa-star m-eval-rate-icon" id="evalR2" data-var="2"></i>
              <i class="fa fa-star m-eval-rate-icon" id="evalR3" data-var="3"></i>
              <i class="fa fa-star m-eval-rate-icon" id="evalR4" data-var="4"></i>
              <i class="fa fa-star m-eval-rate-icon" id="evalR5" data-var="5"></i>
            </div>
            <div class="col-sm-3"></div>

          </div>

      </div>
      <div class="modal-footer">
          <button type="button" class="form-control btn btn-secondary m-upload-close" data-dismiss="modal" >Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade " id="preReg-other-info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <input id="succ" type="hidden" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title" >PRE REGISTRATION</p>
        <i id="pre-mssgArea" style="  color:red"></i>
      </div>
      <div class="modal-body">
        <div class="row">
            <?php $newUser->preReg($uId); ?>
        </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-success" id="savePreReg" >Save changes</button>
          <a  class="btn btn-danger" href="func/logout.php">cancel</a>
        </div>
    </div>
  </div>
</div>
<!--MODAL END-->

<script>
  $(function () {
      var uStat = $("#user-status").val();

      if (uStat==0) {
        $('#preReg-code').modal({backdrop: 'static', keyboard: false});
        $("#preReg-code").modal('show');
      }else if (uStat==2){
        $('#preReg-other-info').modal({backdrop: 'static', keyboard: false});
        $("#preReg-other-info").modal('show');
      }

      $("#validate").on('click',function () {
        var code = $('#preReg-code').find('input').serialize();

        $.ajax({
          type: 'POST' ,
          url: 'func/preReg.php', 
          data: code , 
          success: function (data) {
            if (data=='ok') {
              $("#preReg-code").modal('hide');
              location.reload();
              /*$('#preReg-other-info').modal({backdrop: 'static', keyboard: false});
              $("#preReg-other-info").modal('show');*/
            } else if (data=='invalid'){
              $("#mssgArea").html(data+" Code...");
            }
          }
        });

      });

      $('#savePreReg').on('click',function () {
        var preRegData = $('#preReg-other-info').find('input').serialize();
        

        var user    = $('#pre-user').val().trim(); 
        var nPass   = $('#pre-nPass').val(); 
        var rnPass  = $('#pre-rnPass').val(); 

        if (user.length<6) {
          $('#pre-mssgArea').html('username must be atleast 6 letter/numbers..');
        }else{

          if (nPass!=rnPass) {
            $('#pre-mssgArea').html('password not match');
          }else{
            $('#pre-mssgArea').html('nice');

            $.ajax({
              type: 'POST' ,
              url:  'func/preReg.php' ,
              data: preRegData , 
              success: function (data) {
                if (data=='success') {
                  $("#preReg-other-info").modal('hide');
                } else if(data=='uExist'){
                  $('#pre-mssgArea').html('username already taken');
                }       
                
              } 
            });
          }

        }

      });




      //Upload-Note-SelfRate-EvalRate MODAL ACTIVATION
      $('.m-func-icon').on('click',function () {
        var data_var = $(this).attr('data-var');
        if ( data_var=='upload' ) {
          var val_docu = $(this).find('p');
          var val_docu_root = $(this);

          var sub_title = $(this).attr('sub-a-title');
          var category = $(this).attr('category-no');
          var content = $(this).attr('content-no');
          var cnt_key = $(this).attr('cnt-key');
          
          $('#upload_sub_a').html(sub_title);   
          $('#upload_category').html(category);
          $('#upload_content').html("No. "+content);
          $('#cnt_key').val(cnt_key);
          
          $.ajax({
            type: 'POST' ,
            url:  'func/viewUpload.php' , 
            data: {'cnt_key': cnt_key} ,  
            success: function (a) {
              $('#m-upload-list').html(a);

              $(".m-view-upload").on('click',function () {
                var docu_name = $(this).attr('docu-name');
                var cont_id = $(this).attr('docu-cont');
                var _root = $(this);
                //remove NEW status
                $.ajax({
                  type: 'POST' ,
                  url: 'func/statViewUpload.php' ,
                  data: {'docu_name': docu_name} ,
                  success: function (e) {

                    if (e==1) {
                      var ins_cont = val_docu.html()-1;
                      if (ins_cont == 0) {
                        val_docu_root.html('');
                      }
                      val_docu.html(ins_cont);
                    }

                  }  
                });

                $('#view_docu .modal-dialog .modal-body .row .col-lg-12').html("<iframe src=\""+docu_name+"\" style=\"width:100%; height:500px; zoom:80%; border:0px;\"></iframe> ");

                $('#upload').modal('toggle'); 
                $('#view_docu').modal('show'); 
                
              });

            }
          });

          //SHOW MODAL UPLOAD
          $('#upload').modal('show'); 

        } else if( data_var=='notes' ) {
          var sub_title = $(this).attr('sub-a-title');
          var category = $(this).attr('category-no');
          var content = $(this).attr('content-no');
          var cnt_key = $(this).attr('cnt-key');

          var _root_note = $(this);
          //turn OFF notification
          $.ajax({
            type: 'POST' ,
            url: 'func/statViewNotes.php' ,
            data: {'id' : cnt_key } ,
            success: function (i) {

              if (i==1) {
                _root_note.html('');
              }

            }  
          });
          
          $('#notes_sub_a').html(sub_title);   
          $('#notes_category').html(category);
          $('#notes_content').html("No. "+content);
          $('#notes_cnt_id').val(cnt_key);
          $('#notes_area').html('');

          $.ajax({
            type: 'POST' ,
            url: 'func/notes.php' ,
            data: {'note_cnt_id': cnt_key } , 
            success: function (saved_note) {
              $('#notes_area').html(saved_note);
            }
          });

          $('#notes').modal('show');

        } else if( data_var=='evalRate' ) {

          var sub_title = $(this).attr('sub-a-title');
          var category = $(this).attr('category-no');
          var content = $(this).attr('content-no');
          var cnt_key = $(this).attr('cnt-key');
          
          $('#evalRate_sub_a').html(sub_title);   
          $('#evalRate_category').html(category);
          $('#evalRate_content').html("No. "+content);
          $('#cnt_key').val(cnt_key);

          //SYNCHRONIZE RATE IN #evalrate MODAL (NEED TO SIMPLIFY CODES)
          var current_eval_rate = $(this).html();
          var current_self_rate = $(this).attr('self-rate');
          
          set_rate(current_eval_rate,'eval','gold');
          set_rate(current_self_rate,'self','gold');
          
          $('#evalrate').modal('show');
        }

      });
      
      function set_rate(rate,cat,color) {
        
        if (rate == 0) {
          $('.m-'+cat+'-rate-icon').css({'color':''});
        } else if (rate == 1) {
          $('.m-'+cat+'-rate-icon').css({'color':''});
          $('#'+cat+'R1').css({'color': color });
        } else if (rate == 2) {
          $('.m-'+cat+'-rate-icon').css({'color':''});
          $('#'+cat+'R1').css({'color': color });
          $('#'+cat+'R2').css({'color': color });
        } else if (rate == 3) {
          $('.m-'+cat+'-rate-icon').css({'color':''});
          $('#'+cat+'R1').css({'color': color });
          $('#'+cat+'R2').css({'color': color });
          $('#'+cat+'R3').css({'color': color });
        }  else if (rate == 4) {
          $('.m-'+cat+'-rate-icon').css({'color':''});
          $('#'+cat+'R1').css({'color': color });
          $('#'+cat+'R2').css({'color': color });
          $('#'+cat+'R3').css({'color': color });
          $('#'+cat+'R4').css({'color': color });
        }  else if (rate == 5) {
          $('.m-'+cat+'-rate-icon').css({'color':''});
          $('#'+cat+'R1').css({'color': color });
          $('#'+cat+'R2').css({'color': color });
          $('#'+cat+'R3').css({'color': color });
          $('#'+cat+'R4').css({'color': color });
          $('#'+cat+'R5').css({'color': color });
        }

      }


      //NOTES 
      $('#notes_form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
          type: 'POST' , 
          url:  'func/notes.php' ,
          data: new FormData(this) ,
          contentType: false,
          cache: false ,
          processData: false ,
          success: function (data) {
            /*
            alert(data);
            */
            var current_notes = $('#notes_area').html();
            $('#notes_input').val('');
            $('#notes_input').focus();
            $('#notes_area').html(current_notes+data);
            
          } 
        });
      });


      //EVALUATION RATE
      function evalRateInput(e_val , e_cnt_id) {
        $.ajax({
           type: 'POST' , 
           url: 'func/rate.php' ,
           data: {'eval_rate': e_val , 'e_cnt_id' : e_cnt_id  } ,
           success: function (e) {
            //alert(e);
            $('#eStar_'+e_cnt_id).html(e_val);
           }  
        });
      }

      $('#evalR1').on('click', function () {

        var e_val = $(this).attr('data-var');
        var e_cnt_id = $('#cnt_key').val();
        
        $('.m-eval-rate-icon').css({'color':''});

        $('#evalR1').css({'color':'gold'});
        evalRateInput(e_val , e_cnt_id);

      });
      $('#evalR2').on('click', function () {
        
        var e_val = $(this).attr('data-var');
        var e_cnt_id = $('#cnt_key').val();
        
        $('.m-eval-rate-icon').css({'color':''});

        $('#evalR1').css({'color':'gold'});
        $('#evalR2').css({'color':'gold'});
        evalRateInput(e_val , e_cnt_id);
        
        
      });
      $('#evalR3').on('click', function () {
        
        var e_val = $(this).attr('data-var');
        var e_cnt_id = $('#cnt_key').val();
        
        $('.m-eval-rate-icon').css({'color':''});
        
        $('#evalR1').css({'color':'gold'});
        $('#evalR2').css({'color':'gold'});
        $('#evalR3').css({'color':'gold'});
        evalRateInput(e_val , e_cnt_id);

      });
      $('#evalR4').on('click', function () {
        
        var e_val = $(this).attr('data-var');
        var e_cnt_id = $('#cnt_key').val();
        
        $('.m-eval-rate-icon').css({'color':''});
        
        $('#evalR1').css({'color':'gold'});
        $('#evalR2').css({'color':'gold'});
        $('#evalR3').css({'color':'gold'});
        $('#evalR4').css({'color':'gold'});
        evalRateInput(e_val , e_cnt_id);

      });
      $('#evalR5').on('click', function () {
        
        var e_val = $(this).attr('data-var');
        var e_cnt_id = $('#cnt_key').val();
        
        $('.m-eval-rate-icon').css({'color':''});
        
        $('#evalR1').css({'color':'gold'});
        $('#evalR2').css({'color':'gold'});
        $('#evalR3').css({'color':'gold'});
        $('#evalR4').css({'color':'gold'});
        $('#evalR5').css({'color':'gold'});
        evalRateInput(e_val , e_cnt_id);

      });

  });
</script>


