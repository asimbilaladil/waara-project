<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Samar Mayat Announcement</title>
<style>
.banner {
  position: relative;
  margin: 0 auto;

}

.banner ul,
ol {
  padding: 0;
  margin: 0
}

.banner li {
  width: 100%;
  list-style: none
}



.banner li a {
  text-decoration: none;
  color: #fff
}

#banner ol {
  width: 42px;
  position: absolute;
  left: 50%;
  bottom: 10px;
  z-index: 1000;
  margin-left: -21px;
  overflow: hidden
}

#banner ol li {
  float: left;
  background-color: #fff;
  color: #000;
  margin: 2px;
  width: 10px;
  height: 10px;
  display: block;
  text-align: center;
  cursor: pointer;
  border-radius: 50%;
  font-size: 14px;
  text-indent: -999em;
  list-style: none
}

#banner ol li.active {
  background-color: orange;
  color: #fff
}
  
  html, body {
    height:100%;
    width:100%;
}

.autoheight {
    background-color:blue;
    height:100%;
}

h1 { margin:150px auto 30px auto; text-align:center;}
</style>
<link href="<?php echo base_url(); ?>includes/dist/css/slider/jquerysctipttop.css" rel="stylesheet" type="text/css">
</head>

<body>


<div id="banner" class="banner ">
  <ul>
<?php  foreach($data['news'] as $item) { ?>
     <li >
      <br><br>
 
       <h2 style="color:black; text-align: center;"> <u>Inna lillahi wa inna ilayhi raji'un</u> </h2> 

       <h2 style="color:black; text-align: center; "><u>إِنَّا لِلّهِ وَإِنَّـا إِلَيْهِ رَاجِعونَ</u></h2>
  
       <h2 style="color:black; text-align: center;"> <u>Surely we belong to Allah and to Him we shall return.</u></h2>
      <table width="50%" align="center" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td height="50" align="left" bgcolor="#6699ff" style="font-family:arial,helvetica,sans-serif"><div align="center"><span class="m_6499142801091011232gmail-m_-1957923009777362588m_3443412901826324805gmail-m_4361823867978373955m_246373465077713513m_4159112703164336634m_5948316009063859423m_5660591897036834240gmail-m_-4683344465062615454m_7297931643757956930m_1466892622985816321m_2576116705093882688m_5474185313776458368m_2799921312843568215m_4424414378094864882m_6849436037477044447m_1237367910387060877m_3012215970221365032m_2651591400584417057gmail-m_3906567823192514197m_-5792776948611478313gmail-m_3641235477312817160m_-1340894739414463546m_-8483502225160643804m_8154212374973998732m_-3540531316640539918m_636031031425782495m_8806542043092702668m_-3335059866671968382m_2184531189524574975m_6443365583059595135m_-6393011311386205475m_8511534187185335091m_5399080736660332687m_-853503095817207546m_-3569321976907592603m_8654374921958181516m_-4958524249021223459m_-7007716396441535220m_-1251574699793919355m_842210619570485348m_-8128167780851713348m_-331182311217151483m_-4588763495784356203m_-169280651504361527gmail-m_8749664430098285096Article m_6499142801091011232gmail-m_-1957923009777362588m_3443412901826324805gmail-m_4361823867978373955m_246373465077713513m_4159112703164336634m_5948316009063859423m_5660591897036834240gmail-m_-4683344465062615454m_7297931643757956930m_1466892622985816321m_2576116705093882688m_5474185313776458368m_2799921312843568215m_4424414378094864882m_6849436037477044447m_1237367910387060877m_3012215970221365032m_2651591400584417057gmail-m_3906567823192514197m_-5792776948611478313gmail-m_3641235477312817160m_-1340894739414463546m_-8483502225160643804m_8154212374973998732m_-3540531316640539918m_636031031425782495m_8806542043092702668m_-3335059866671968382m_2184531189524574975m_6443365583059595135m_-6393011311386205475m_8511534187185335091m_5399080736660332687m_-853503095817207546m_-3569321976907592603m_8654374921958181516m_-4958524249021223459m_-7007716396441535220m_-1251574699793919355m_842210619570485348m_-8128167780851713348m_-331182311217151483m_-4588763495784356203m_-169280651504361527gmail-m_8749664430098285096Head" style="color:rgb(255,255,255);font-size:22px"><u>&nbsp;Funeral Announcement</u></span></div></td></tr></tbody></table>
      <br><br>
          <?php 

              if($item->type == 'samar'){
                  $data['content'] = str_ireplace("TITLE",$item->title ,$data['content'] );
                  $data['content']  = str_ireplace("FIRST-NAME",$item->first_name ,$data['content'] );
                  $data['content']  = str_ireplace("LAST-NAME",$item->last_name ,$data['content'] );
                  $data['content']  = str_ireplace("ORIGINAL-FROM",$item->original_from ,$data['content'] );
                  $data['content']  = str_ireplace("AGE",$item->age ,$data['content'] );
                  $data['content']  = str_ireplace("SAMAR-ON",$item->on ,$data['content'] );
                  $data['content']  = str_ireplace("OBSERVED-BY",$item->observedBy ,$data['content'] );
                  $data['content']  = str_ireplace("FAMILY-NAME",$item->familyName ,$data['content'] );
                  $data['content']  = str_ireplace("FAMILY-PHONE",$item->familyPhone ,$data['content'] );
                  $data['content']  = str_ireplace("SUBMITTED-BY",$item->submittedBy ,$data['content'] );
                  $data['content']  = str_ireplace("POSITION",$item->position ,$data['content'] );
                  $data['content']  = str_ireplace("PHONE",$item->phone ,$data['content'] );
                  $data['content']  = str_ireplace("JK-NAME",$item->jkName ,$data['content'] );
              } else {
                  $data['content']  = str_ireplace("TITLE",$item->title ,$data['content'] );
                  $data['content']  = str_ireplace("FIRST-NAME",$item->first_name ,$data['content'] );
                  $data['content']  = str_ireplace("LAST-NAME",$item->last_name ,$data['content'] );
                  $data['content']  = str_ireplace("ORIGINAL-FROM",$item->original_from ,$data['content'] );
                  $data['content']  = str_ireplace("PERSON-AGE",$item->age ,$data['content'] );
                  $data['content']  = str_ireplace("FUNERAL-DATE",$item->funeral_date ,$data['content'] );
                  $data['content']  = str_ireplace("MAYAT-DATE",$item->date ,$data['content'] );
                  $data['content']  = str_ireplace("MAYAT-TIME",$item->time ,$data['content'] );
                  $data['content']  = str_ireplace("TYPE",$item->type ,$data['content'] );
                  $data['content']  = str_ireplace("JK-NAME",$item->jkName ,$data['content'] );
              }
              echo $data['content'] ;
          ?>

       
       <p style="font-size: large;">
      </p>
        <br><br>
<table width="50%" align="center" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td height="50" bgcolor="#6699ff" style="font-family:arial,helvetica,sans-serif;text-align:center">
  <span style="color:rgb(159,197,232)"><span style="color:rgb(0,0,0)"><a href="http://docs.wixstatic.com/ugd/5c9e16_fb52169575a1488aab1bc4f975757ce4.pdf" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://docs.wixstatic.com/ugd/5c9e16_fb52169575a1488aab1bc4f975757ce4.pdf&amp;source=gmail&amp;ust=1513244883580000&amp;usg=AFQjCNF0XnM0O5LWFdp16_QoAwO6GFslwA"><span style="color:rgb(255,255,255)"></span></a></span><u></u></span><br></td></tr></tbody></table>      
      <br><br>
    </li>
   <?php } ?>
    
  </ul>
</div>
<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script> 
<script src="<?php echo base_url(); ?>includes/dist/js/slider/jQuery.autoSlider.js"></script> 
<script>
  $(function(){
    $('.banner').autoSlider({
      speed: 1000, 
      delay: 5000, 
      dots: false, 
      stay: true,
      fluid: true 
    });
  });
  </script>


</body>
</html>
