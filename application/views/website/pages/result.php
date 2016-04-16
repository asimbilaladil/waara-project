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

                <p>   <div><div id="chart_div"></div>
        <div id="chart_div3"></div></div>


          <?php
            $votes = [];
            $candidates = []; 
            foreach($result  as $data) {
              array_push($votes, $data['votes']);
              array_push($candidates , $data['name']);
            } 
          ?>
        </p>
            </div>
        </div>
    </div>
</div>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">

          // Load the Visualization API and the piechart package.
          google.load('visualization', '1.0', {'packages':['corechart']});

          // Set a callback to run when the Google Visualization API is loaded.
          google.setOnLoadCallback(drawChart);

          // Callback that creates and populates a data table,
          // instantiates the pie chart, passes in the data and
          // draws it.
          function drawChart() {

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Candidates');
            data.addColumn('number', 'Votes');

            var votes = <?php echo json_encode($votes); ?> ;
            var candidates = <?php echo json_encode($candidates); ?> ;
            var data3 = new google.visualization.DataTable();
            data3.addColumn('string', 'Candidates');
            data3.addColumn('number', 'Votes');
        
            for(i = 0; i < candidates.length; i++)
            {
                  data3.addRow([candidates[i], parseInt(votes[i]) ]);
                  data.addRow([candidates[i], parseInt(votes[i]) ]);
              
            }

            // Set chart options
            var options = {'title':'Pie Chart',
                           'width':600,
                           'height':400};

            // Set chart options
            var options3 = {'title':'Bar chart',
                           'width':600,
                           'height':400};

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
            var chart3 = new google.visualization.BarChart(document.getElementById('chart_div3'));
            chart3.draw(data3, options3);
        }
    </script>
  
