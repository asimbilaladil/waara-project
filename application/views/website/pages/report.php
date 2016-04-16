<div class="product-big-title-area"
     style="background: url(<?php echo base_url("includes/website/img/crossword.png") ?>) repeat scroll 0 0 #1ABC9C">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Report</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">

    <div class="container">
        <div class="row">

        </div>

        <div class="row">
            <div class="col-md-12 registration">
                <h3></h3>

                <p>   
      <form action="<?php echo site_url('WebAction/result') ?>" method="POST">
        <select name="event">

          <?php foreach($result  as $data) { ?>
          <option value= "<?php echo $data->event_id; ?> "><?php echo $data->event_title; ?>  </option>
          <?php } ?>

        </select>
        </br></br>
        <button type="submit">See The Result</button>
        </p>
        </form>
            </div>
        </div>
    </div>
</div>
 
  
