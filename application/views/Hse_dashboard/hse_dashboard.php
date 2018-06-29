<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA HSE_SASARAN_MUTU_DETAIL</h3>
                    </div>
        
        <div class="box-body">

        </div>
                    </div>
            </div>

            </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.min.js"></script>
        <script src="<?php echo base_url() ?>assets/adminlte/chartjs.js"></script>



  <?php
        foreach($graf as $data){
            $merk[] = $data->departmen;
            $stok[] = (float) $data->stok;
            $periode[] = $data->periode;
            $target[] = $data->target;
        }
    ?>
  <canvas id="myChart" name ="myChart" width="800" height="280"></canvas>

    </section>
</div>
<script>
var ctx = document.getElementById('myChart').getContext('2d');

var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: <?php echo json_encode($periode);?>,
    datasets: [{
      label: 'HASIL AUDIT',
      data: <?php echo json_encode($stok);?>,
      backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
    },
    {
   label: 'TARGET',
      data: <?php echo json_encode($target);?>,
      backgroundColor: 
                'rgba(153, 102, 255, 0.2)',
            borderColor: 
                'rgba(153, 102, 255, 0.2)',
            borderWidth: 1
    } 

    ]
  },
   options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                     min: 0,
           max: 100,
           callback: function(value) {
               return value + "%"
           }
                }
            }]
        },

         title: {
            display: true,
            text: 'CAPAIAN SASARAN MUTU DEPARTMEN',
            fontSize  : 25
        }
    }
});
        
    </script>